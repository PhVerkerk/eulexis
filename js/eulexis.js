$(document).ready(function() {

  // Infobulles sur les lemmes
  $('#results').tooltip({
    selector : "[data-toggle=tooltip]",
    container : "body",
    html : "false",
    placement : "bottom"
  });

  // Reset texte
  $(".form-lemme input[type='reset']").click(function(event) {
    event.preventDefault();
    $("#lemmatiser_texte").empty();
  });

  // Soumission du formulaire pour traitement
  $(".form-lemme input[type='submit']").click(function(event) {
    event.preventDefault();

    // Type d'operation
    var opera = $(this).siblings("input[value='true']").attr("name");
    // Valeur du token
    //var token = $(this).siblings("input[name='token']").val();

    // Definition variables et parametres POST en fonction de l'operation
    switch( opera ) {

      case "consultation":
        var lemme = $("#recherche_lemme").val();
        var dico = $("#dicos option:selected").val();
        $("#dicos").change(function() {
          var dico = $(this).val();
        });
        var dataString = 'lemme=' + lemme + '&dicos=' + dico;
        break;

      case "flexion":
        var lemme = $("#flexion_lemme").val();
        var dataString = 'lemme=' + lemme + '&' + opera + '=';
        break;

      case "lemmatisation":
        //var action = $(this).val();
        var grec = $("#lemmatiser_texte").val();
        var exacte = $("input:checked");
        if (exacte.length) {
          var dataString = 'grec=' + grec + '&' + opera + '=' + '&' + 'exacte=';
        } else {
          var dataString = 'grec=' + grec + '&' + opera + '=';
        }
        break;
    }

    if (lemme || grec) {
      ajaxRequest(dataString);
    } else {
      $('#modal-error').modal()
    }

  });

  function ajaxRequest(dataString) {
    $.ajax({
      type : "POST",
      url : "traitement.php",
      data : dataString,
      dataType : "html",
      cache : false,
    }).done(function(data) {
      $("#results").html(data);

      /*
       * ScrollToTop top button
       */
      var divResults = $("#results");

      /*var imgDico = $("#results img");
      var imgDicoWidth = imgDico.width();*/

      // Calculate best horizontal position
      var divResultsOffsetTop = divResults.offset().top;
      var divResultsOffsetTop = divResultsOffsetTop + 20;
      var divResultsWidth = divResults.width();
      var divResultsHeight = divResults.height();
      var windowWidth = $(window).width();
      var positionRight = (windowWidth - divResultsWidth) / 2 - 60;

      $(window).scroll(function() {
        if ($(this).scrollTop() > divResultsOffsetTop) {
          $("#scrollToTop").css("right", positionRight).fadeIn();
        } else {
          $("#scrollToTop").fadeOut();
        }
      });

      // Click event to go to top of #results
      $("#scrollToTop a").click(function() {
        $("html, body").animate({
          scrollTop : $("#results").offset().top
        }, 800);
        return false;
      });

      $('html, body').animate({
        scrollTop : $("#results").offset().top
      }, 600);

      afterHtmlAppendCallback();

    }).fail(function() {
      $("#results").html("<p class='text-danger'><strong>Une erreur s'est produite<strong></p>");
    });
  }

  /*
   * afterHtmlAppendCallback()
   * Fonction appelee dans done() apres injection de la reponse html
   */

  function afterHtmlAppendCallback() {

    /*
     * Selection et memorisation mise en page dicos
     */

    if ($(".table-dicos").length) { // Si la div dicos existe dans #results

      var selectedLayout = sessionStorage.getItem("layout");

      var selectLayoutDiv = document.createElement("div");
      var columnBtn = document.createElement("a");
      var rowBtn = document.createElement("a");
      selectLayoutDiv.setAttribute("class", "selectLayoutDiv");
      columnBtn.setAttribute("href", "#");
      columnBtn.setAttribute("class", "columnBtn");
      columnBtn.setAttribute("title", "Affichage en colonnes");
      rowBtn.setAttribute("href", "#");
      rowBtn.setAttribute("class", "rowBtn");
      rowBtn.setAttribute("title", "Affichage en lignes");
      selectLayoutDiv.appendChild(columnBtn);
      selectLayoutDiv.appendChild(rowBtn);

      $(".table-dicos").before(selectLayoutDiv);

      var selectedClass = "selected";

      if (selectedLayout == 'column') {
        $(".columnBtn").addClass(selectedClass);
      } else {
        $(".rowBtn").addClass(selectedClass);
      }

      $(".dicos div").each(function() {
        if (sessionStorage.layout) {
          $(this).attr("class", selectedLayout);
        } else {
          // default
          $(this).attr("class", "row");
        }
      });

      // Bouton "en colonnes"
      $(".columnBtn").click(function(event) {
        event.preventDefault();

        $(this).addClass(selectedClass);
        $(".rowBtn").removeClass(selectedClass);

        $(".dicos div").toggleClass("row column");

        selectedLayout = $(".dicos div:first-child").attr("class");
        sessionStorage.setItem("layout", selectedLayout);
      });

      // Bouton "en rangees"
      $(".rowBtn").click(function(event) {
        event.preventDefault();

        $(this).addClass("selected");
        $(".columnBtn").removeClass(selectedClass);

        $(".dicos div").toggleClass("column row");

        selectedLayout = $(".dicos div:first-child").attr("class");
        sessionStorage.setItem("layout", selectedLayout);
      });

    }

    /*
    * Requetes pour les liens sur lemmes
    */

    // Dans les entrees de dicos
    $("a[data-lemme]").click(function(event) {
      event.preventDefault();

      var lemme = $(this).attr("data-lemme");
      var dataString = 'lemme=' + lemme;
      ajaxRequest(dataString);
    });

    // Dans la colonne laterale mots voisins et le pager
    $("a[data-pos]").click(function(event) {
      event.preventDefault();

      var pos_ind = $(this).attr("data-pos");
      var dataString = 'pos_ind=' + pos_ind;
      ajaxRequest(dataString);
    });

    /*
     * Scroll anime vers ancres
     */
    $('a[href^=#]:not([href=#])').click(function() {
      //if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop : target.offset().top
        }, 1000);
        return false;
      }
      //}
    });
  }
});

$(document).ready(function() {
  
  $(".form-control").keyup(function(e) {
    // Valeur Unicode de la touche
    var keyCode = e.keyCode;
    
    // Conversion valeur Unicode en caractere
    keyString = String.fromCharCode(keyCode);
    // Mise en minuscules
    keyString = keyString.toLowerCase();
    // Caractere grec correspondant dans lat_grc.json
    value = lat_grc[keyString];
  
    if (value) {
      // insere le caractere a la position du curseur
      if (this.selectionStart || this.selectionStart == '0') { // FF
        var startPos = this.selectionStart;
        var endPos = this.selectionEnd;
        this.value = latGrc(this.value);
        this.focus();
        this.setSelectionRange(startPos, startPos);
      }
      else if (document.selection && document.selection.createRange) { // IE
        sel = document.selection.createRange();
        sel.moveStart('character', -1); // select one char back
        sel.text = value; // replace this latin char by a greek char
      }
      else { // replace complete value, caret position is lost
        this.value = latGrc(this.value);
      }
    }
  });
  
  function latGrc(text) {
    text=text.split('');
    max=text.length;
    for (var i=0; i<max; i++) {
      c=lat_grc[text[i]];
      if (c) text[i]=c;
    }
    return text.join('');
  }
});