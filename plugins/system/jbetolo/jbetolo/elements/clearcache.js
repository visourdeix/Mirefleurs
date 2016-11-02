/**
* @version:	2.6.1.a2a4257 - 2014 September 15 10:13:22 +0300
* @package:	jbetolo
* @subpackage:	jbetolo
* @copyright:	Copyright (C) 2010 - 2014 jproven.com. All rights reserved. 
* @license:	GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
*/

var jbetoloclearcache = new Class({
        Implements: [Options],
        
        initialize: function(options) {
                this.setOptions(options);

                window.addEvent('domready', function(){
                        this.assignActions();
                }.bind(this));
        },

        assignActions: function() {
                document.id('clearSiteCacheBtn').addEvent('click', function() { this.clearCache('site'); }.bind(this));
                document.id('clearAdministratorCacheBtn').addEvent('click', function() { this.clearCache('administrator'); }.bind(this));
        },

        /** field/param element actions **/

        clearCache: function(app){
                new Request({
                        onSuccess: function(response) {
                                alert(this.options.PLG_SYSTEM_JBETOLO_CACHE_CLEARED.replace('%s', app));
                        }.bind(this),
                        url: this.options.base+'index.php?option=com_jbetolo&task=clearcache&app='+app,
                        noCache: true
                }).send();
                
                return false;
        }        
});