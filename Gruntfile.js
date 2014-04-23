module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    stylus: {
      compile: {
        options: {
        },
        files: {
          'public/stylesheets/screen.css': ['views/stylus/screen.styl']
        }
      }
    },
    watch: {
      stylus: {
        files: ['views/stylus/*.styl'],
        tasks: ['stylus'],
        options: {
          spawn: false,
          livereload: true
        },
      },
      js: {
        files: ['public/js/*.js'],
        options: {
          spawn: false,
          livereload: true
        },
      },
      jade: {
        files: ['views/jade/*.jade'],
        options: {
          spawn: false,
          livereload: true
        },
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-stylus');
  grunt.loadNpmTasks('grunt-contrib-watch');
  
  grunt.registerTask('default', ['stylus']);
  grunt.registerTask('dev', ['default', 'watch']);
};
