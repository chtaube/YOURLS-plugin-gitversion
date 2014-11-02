YOURLS-gitversion plugin
========================

If you are running [YOURLS](http://yourls.org) from a release tarball this plugin is nothing for you.

But if you are following the [YOURLS](https://github.com/YOURLS/YOURLS) repository
on GitHub to stay on the edge of the latest commits and improvements, this plugin might be of interest for you.

This plugin simple adds version information from the git repository into the footer of the admin page. The version information is derived from the output of `git describe --long`.

Before:

	Powered by YOURLS v 1.7.1 – 5 queries

After:

	Powered by YOURLS v 1.7.1 – 3 queries
	v 1.7-git-80.37f54c7 on remotes/upstream/master

Meaning the last commit in your repository is named [37f54c7](https://github.com/YOURLS/YOURLS/commit/37f54c79223c21f0ef7cd15ab62992f9205f748e) which is *80 commits* in the future of [version tag *1.7*](https://github.com/YOURLS/YOURLS/tree/1.7). – Now, isn't that cool!? ;)


# Installation

## Git Hooks
Currently, the plugin does not execute `git describe` directly, but depends on
a `version` file that is being updated on each checkout or commit by a Git hook. Some simple hook files are included in the `git-hooks/` directory. Just copy them into `.git/hooks/` of your YOURLS installation.

If you already have your own hooks file, add this line to your existing
file:

	git describe --long > $GIT_DIR/version


## Plugin installation
Copy the plugin directory `gitversion/` to your YOURLS plugin directory `user/plugins/`. The result would look like `user/plugins/gitversion/plugin.php`.

Go to the admin panel and activate the plugin *Git Version*.

