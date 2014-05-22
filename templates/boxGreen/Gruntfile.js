module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            dist: {
				src: [
					'js/_united_side_plugins.js',
					'js/_plugins.js',
					'js/drop_extend_methods.js',
					'js/_shop.js',
					'js/_global_vars_objects.js',
					'js/_functions.js',
					'js/_scripts.js'
				],
				dest: 'js/united_scripts_full.js',
			}
        },
		uglify: {
			build: {
				src: 'js/united_scripts_full.js',
				dest: 'js/united_scripts.js'
			}
		}
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat', 'uglify']);

};