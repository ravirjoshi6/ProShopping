module.exports = function(grunt) { 
 grunt.initConfig({
    uglify: {      
      dist: {
        files: {
          'WEB-INF/scripts/dist/jquery.min.js':['WEB-INF/scripts/lib/jquery.js'],
          'WEB-INF/scripts/dist/jquery-ui.min.js':['WEB-INF/scripts/lib/jquery-ui.js'],
          'WEB-INF/scripts/dist/jquery.flexisel.min.js':['WEB-INF/scripts/lib/jquery.flexisel.js'],
          'WEB-INF/scripts/dist/jquery.flexslider.min.js':['WEB-INF/scripts/lib/jquery.flexslider.js'],          
          'WEB-INF/scripts/dist/memenu.min.js':['WEB-INF/scripts/lib/memenu.js'],
          'WEB-INF/scripts/dist/simpleCart.min.js': ['WEB-INF/scripts/lib/simpleCart.js'],
          'WEB-INF/scripts/dist/angular.min.js': ['WEB-INF/scripts/lib/angular.js'],
          'WEB-INF/scripts/dist/proshopping.min.js': ['WEB-INF/scripts/app/**.js']
        }
      }
    }
  });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.registerTask('default', ['uglify']);

}