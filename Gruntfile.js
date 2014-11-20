module.exports = function(grunt){
    grunt.initConfig({
	pkg: grunt.file.readJSON("package.json"),
	concat: {
	    options: {
		separator: ';'
	    },
	    dist : {
		src: ["app/scripts/**/*.js","bower_components/**/*.min.js","bower_components/**/*-.min.js"],
		dest: "dist/<%= pkg.name %>.js"
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
		    cwd: "app/views",
		    src: "**/*.jade",
		    dest: "dist",
		    expand: true,
		    ext: ".html"
		}]
	    }
	},
	sass : {
	    src: ["app/styles/**/*.scss"],
	    dest: "dist/<%= pkg.name %>.css"
	},
	serve : {
	    
	}
    });
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-jshint");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-jade");
    grunt.loadNpmTasks("grunt-contrib-sass");

    grunt.registerTask("default",["jade","jshint","concat"]);
};
