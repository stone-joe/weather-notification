module.exports = function(grunt){
    grunt.initConfig({
	pkg: grunt.file.readJSON("package.json"),
	concat: {
	    js_and_css: {
		files: {
		    "app/sass_dist/weather.scss": ["app/sass/**/*.scss"],
		    "dist/main.js": ["app/scripts/weather.js","app/scripts/**/*.js"]
		}
	    }
	},
	uglify: {
	    options: {
		banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
	    },
	    dist : {
		files: {
		    'dist/<%= pkg.name %>.min.js': [""]
		}
	    }
	},
	jshint : {
	    files: ["Gruntfile.js","app/scripts/**/*.js"]
	},
	jade : {
	    compile: {
		options: {
		    client: false,
		    pretty: true
		},
		files: [{
		    cwd: "app",
		    src: "**/*.jade",
		    dest: "dist",
		    expand: true,
		    ext: ".html"
		}]
	    }
	},
	compass: {
	    dist: {
		options: {
		    sassDir: "app/sass_dist",
		    cssDir: "dist"
		}
	    }
	},
	serve : {
	    options: {
		port: 9000
	    },
	    path: "dist"
	}
    });
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-jshint");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-jade");
    grunt.loadNpmTasks("grunt-contrib-compass");
    grunt.loadNpmTasks("grunt-serve");

    grunt.registerTask("default",["jade","jshint","concat","compass","serve"]);

    grunt.registerTask("js",["jshint","concat","serve"]);

    grunt.registerTask("style",["concat","compass","serve"]);
};
