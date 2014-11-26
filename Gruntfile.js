module.exports = function(grunt){
  
  grunt.loadNpmTasks('grunt-contrib-uglify');
  //grunt.loadNpmTasks('grunt-contrib-connect');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    
    uglify: {
      options: {
        preserveComments: 'false'
      },
      dist: {
        src: 'js/eulexis.js',
        dest: 'js/eulexis.min.js'
      }
    },
    
    /*connect: {
      server: {
        options: {
          port: 8000,
          keepalive: true,
          base: '.'
        }
      }
    }*/
  });

  grunt.registerTask('default', ['uglify'])
  //grunt.registerTask('server', ['connect']);

};