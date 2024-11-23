#!/usr/local/bin/perl
#
# This tool will read all PHP files for text to be translated and
# generate a translation file that is neatly divided up by page.
#
# You can use this tool to reorganize a translation file by page
# (which is not how the translation file was originally layed out.)
# 
# If you specify a translation file as an argument to this tool, it
# will use those translations in the output it generates.
#
# The generated results are written to standard output (the console),
# so you need to save the output.
#
# Note you will lose any comments you put in the translation file
# when using this tool (except for the comments at the very beginning).

# Usage:
#	pagify_translation.pl
#		(creates an empty translation file).
#	pagify_translation.pl languagefile
#		(creates an updated translation file using languagefile)
# Example:
#	pagify_translation.pl ../translations/English-US.txt > out.txt
#
# Note: this utility should be run from this directory (tools).
#
###########################################################################


$infile = $ARGV[0];
#
# Now load the translation file
if ( -f $infile ) {
  open ( F, $infile ) || die "Error opening $infile";
  $in_header = 1;
  while ( <F> ) {
    chop;
    if ( $in_header && /^#/ ) {
      if ( $header !~ /pagified/ ) {
        $header .= $_ . "\n";
      }
    }
    next if ( /^#/ );
    if ( /\s*:\s*/ ) {
      $abbrev = $`;
      $trans{$abbrev} = $';
      $in_header = 0;
    }
  }
}

if ( $header !~ /pagified/ ) {
  ( $day, $mon, $year ) = ( localtime ( time() ) )[3,4,5];
  $header .= "#\n# Translation last pagified on " .
    sprintf ( "%02d-%02d-%04d", $mon + 1, $day, $year + 1900 ) . "\n";
}

# First get the list of .php files
opendir ( DIR, ".." ) || die "Error opening ..";
@files = grep ( /\.php$/, readdir ( DIR ) );
closedir ( DIR );

opendir ( DIR, "../includes" ) || die "Error opening ../includes";
@incfiles = grep ( /\.php$/, readdir ( DIR ) );
closedir ( DIR );
foreach $f ( @incfiles ) {
  push ( @files, "includes/$f" );
}
push ( @files, "tools/send_reminders.php" );

print $header;

foreach $f ( @files ) {
  print "\n\n###############################################\n# Page: $f\n#\n";
  $file = "../$f";
  open ( F, $file ) || die "Error reading $file";
  #print "Checking $f for text.\n";
  %thispage = ();
  while ( <F> ) {
    $data = $_;
    while ( $data =~ /(translate|tooltip)\s*\(\s*"/ ) {
      $data = $';
      if ( $data =~ /"\s*\)/ ) {
        $text = $`;
	if ( defined ( $thispage{$text} ) ) {
          # text already found within this page...
	} elsif ( defined ( $text{$text} ) ) {
          print "# \"$text\" previously defined (in $foundin{$text})\n";
	  $thispage{$text} = 1;
	} else {
          $text{$text} = 1;
	  $foundin{$text} = $f;
	  $thispage{$text} = 1;
          printf ( "%s: %s\n", $text, $trans{$text} );
        }
        $data = $';
      }
    }
  }
  close ( F );
}

# Count missing translations
foreach $text ( sort { uc($a) cmp uc($b) } keys ( %text ) ) {
  if ( ! defined ( $trans{$text} ) ) {
    $notfound++;
  }
}

if ( ! $notfound ) {
  print STDERR "All text was found in $infile.  Good job :-)\n";
} else {
  print STDERR "$notfound translation(s) missing.\n";
}

exit 0;
