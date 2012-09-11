
Sass Plugin for PieCrust
---------------------------

This plugin adds file processors for [Sass][] to [PieCrust][].


## Configuration

You can tweak the Sass processor in the site configuration like so:

    site:
        title: Blah blah
    
    # Sass config section.
    sass:
        # Include paths (-I option).
        load_paths: [ foo/bar, /usr/share/foo ]
        # Custom options
        misc_options: []


The `--cache-location` option is set automatically to `_cache` when caching is
enabled in **PieCrust**. The `--no-cache` option is given if caching is
disabled.

If `sass` and `scss` are not in your `PATH` environment variable, you can tell
**PieCrust** where to find them with the `sass/bin_dir` configuration setting.


  [sass]: http://sass-lang.com/
  [piecrust]: http://bolt80.com/piecrust/

