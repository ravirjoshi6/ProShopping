module.exports = function(grunt) { 
 grunt.initConfig({
    uglify: {      
      dist: {
        files: {
          'WEB-INF/scripts/dist/proshopping.min.js': ['WEB-INF/scripts/**.js']
        }
      }
    }
  });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.registerTask('default', ['uglify']);

}