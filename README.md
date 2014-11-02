YOURLS-gitversion plugin
========================

If you are running [YOURLS](http://yourls.org) from a release tarball this
plugin is nothing for you.

But if you are following the [YOURLS repository on
GitHub](https://github.com/YOURLS/YOURLS) to stay on the edge of the latest
commits and improvements, maybe this plugin is for you!

This plugin adds version information from the git repository into the
footer of the admin page. The version information is derived from the output of
`git describe --long --tags`.

Before:

	Powered by YOURLS v 1.7.1 – 3 queries

After:

	Powered by YOURLS v 1.7.1 – 3 queries
	v 1.7-git-80.37f54c7 (remotes/upstream/master)

Meaning the last commit in your repository is named
[37f54c7](https://github.com/YOURLS/YOURLS/commit/37f54c79223c21f0ef7cd15ab62992f9205f748e)
which is *80 commits* in the future of [version tag
*1.7*](https://github.com/YOURLS/YOURLS/tree/1.7). – Now, how cool is that!? ;)


# Installation

## Git Hooks

Currently, the plugin does not execute `git describe` directly, but depends on
a `version` file that is being updated on each checkout or commit by a Git
hook. Some simple hook files are included in the `git-hooks/` directory. Just
copy them into `.git/hooks/` of your YOURLS installation and make them
executable (on POSIX like systems: `chmod +x
.git/hooks/post-{commit,checkout}`.


## Plugin installation

Copy the directory `gitversion/` from this repository to your YOURLS plugin
directory `user/plugins/` (as a result the YOURLS-directory
`user/plugins/gitversion` should show the file `plugin.php`).

Go to the admin panel and activate the plugin *Git Version*.

Please note, the `version` file will be written on the next *checkout* or
*commit*.  Before that, the plugin simply tell you that it is missing the file.

