"use strict";

module.exports = function(grunt) {
    grunt.initConfig({
        // Package
        pkg: grunt.file.readJSON('package.json'),
        // Directories
        dir: {
            dev: {
                css: 'components/css/',
                js: 'components/js/'
            },
            prod: {
                min: 'components/min/'
            }
        },
        // CSS min
        cssmin: {
            options: {
                keepSpecialComments: 0,
                report: 'min'
            },
            main: {
                files: {
                    '<%= dir.prod.min %>main.min.css': '<%= dir.dev.css %>main.css'
                }
            }
        },
        // Concat
        concat: {
            main: {
                src: [
                    '<%= dir.dev.js %>*.js'
                ],
                dest: '<%= dir.prod.min %>built.js'
            }
        },
        removelogging: {
            dist: {
                src: '<%= dir.prod.min %>built.js',
                dest: '<%= dir.prod.min %>built.js',

                options: {
                    // see below for options. this is optional. 
                }
            }
        },
        uglify: {
            options: {
                preserveComments: false,
                compress: {},
                report: 'min'
            },
            main: {
                files: {
                    '<%= dir.prod.min %>main.min.js': '<%= dir.prod.min %>built.js'
                }
            }
        }
    });

    // Modules

    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-remove-logging');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default task

    grunt.registerTask('default', ['cssmin', 'concat', 'removelogging', 'uglify']);

};