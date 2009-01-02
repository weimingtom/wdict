          WDict, yet another web dictionary
=====================================================================
@author   NGUYEN-DAI Quy <vnpenguin@vnoss.org>
@license  http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
@url      http://vnoss.org http://forum.vnoss.org 
@homepage http://code.google.com/p/wdict/
=====================================================================

Features:
---------
    * UTF-8 support
    * Ajax Autocomplete with Jquery
    * Audio support (Text-to-Speech) is available for english only 
      for this moment, but support for any language can be added painlessly 

Requirements:
------------
    * PHP
    * MySQL with UTF-8 support 
    * Javascript in web client

Available MySQL data:
---------------------
    * English-Vietnamese
    * Vietnamese-English
    * French-Vietnamese
    * Vietnamese-French 

Support Text-to-Speech
-----------------------
    * English (from Stardict project) 

Software/component used in WDict:
---------------------------------
  * Dictionary data from http://www.informatik.uni-leipzig.de/~duc/Dict/index.html
  * jQuery toolkit
  * XSPF Web Music Player (Flash) from http://musicplayer.sourceforge.net/
  * TTS data of Stardict project from http://stardict.sourceforge.net/

Credits:
---------
  * Workaround for Collation UTF8 in MySQL by Long Dinh Le (skz0) <longld AT gmail DOT com>
  * Audio support started by Nguyen Duy Tho <nguyenduytho AT gmail DOT com>
