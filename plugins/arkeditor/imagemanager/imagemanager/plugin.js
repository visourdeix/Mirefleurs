(function(){function t(n){var t=n.getSelection();return(element=t&&t.getSelectedElement()||null,element&&element.is("img")&&!element.data("cke-realelement")&&!element.isReadOnly())?element:!1}var n="arkimage";CKEDITOR.plugins.add("imagemanager",{requires:"image",icons:"image",hidpi:!0,init:function(i){var r={href:i.config.base+"index.php?option=com_media&view=images&tmpl=component&e_name={EDITOR}&asset=com_content&arkimage=1&author=",exec:function(n){var u,e,f,i,r;this.href=this.href.replace("{EDITOR}",n.name);u=this;e=function(n){n.cancel()};n.editable().once("blur",e,null,null,-100);if(jQuery.fn.squeezeBox?jQuery.fn.squeezeBox({handler:"iframe",size:{x:800,y:500},url:this.href},!0):SqueezeBox.open(null,{handler:"iframe",size:{x:800,y:500},url:this.href}),f=t(n),f){if(i=function(){var t=n.getSelection();CKEDITOR.env.ie&&t&&(n._bookmarks=t.createBookmarks2());CKEDITOR.tools.setTimeout(function(){if(typeof SqueezeBox=="object")SqueezeBox.removeEvent("onOpen",i);else jQuery(ARK.squeezeBox).on("onOpen",i)},0,u)},r=function(){var t=CKEDITOR.document.getById("sbox-window").findOne("#sbox-content iframe");t.on("load",function(){var i=t.getFrameDocument(),e=i.getWindow().$.ImageManager;e.populateElementValues||(e.populateElementValues=function(t){var u=(t.data("cke-saved-src")||t.getAttribute("src")).replace(n.config.base,""),r;this.fields.url.value=u;this.fields.alt.value=t.getAttribute("alt");this.fields.title.value=t.getAttribute("title");t.hasClass("pull-left")?(this.fields.align.value="left",r=this.fields.align.options[this.fields.align.selectedIndex].text,i.findOne("#f_align_chzn a.chzn-single span").setText(r)):t.hasClass("pull-center")?(this.fields.align.value="center",r=this.fields.align.options[this.fields.align.selectedIndex].text,i.findOne("#f_align_chzn a.chzn-single span").setText(r)):t.hasClass("pull-right")?(this.fields.align.value="right",r=this.fields.align.options[this.fields.align.selectedIndex].text,i.findOne("#f_align_chzn a.chzn-single span").setText(r)):(this.fields.align.value="",r=this.fields.align.options[this.fields.align.selectedIndex].text,i.findOne("#f_align_chzn a.chzn-single span").setText(r))});e.populateElementValues(f,n);CKEDITOR.tools.setTimeout(function(){if(typeof SqueezeBox=="object")SqueezeBox.removeEvent("onOpen",r);else jQuery(ARK.squeezeBox).on("onOpen",r)},0,u)})},CKEDITOR.env.ie)if(typeof SqueezeBox=="object")SqueezeBox.addEvent("onOpen",i);else jQuery(ARK.squeezeBox).on("onOpen",i);if(typeof SqueezeBox=="object")SqueezeBox.addEvent("onOpen",r);else jQuery(ARK.squeezeBox).on("onOpen",r)}}},u=i.addCommand(n,r);u.modes={wysiwyg:1};i.ui.addButton&&i.ui.addButton("Image",{label:i.lang.common.image,command:n});i.on("doubleclick",function(t){var r=t.data.element;if(r.is("img")&&!r.data("cke-realelement")&&!r.isReadOnly())return i.execCommand(n),!1},null,null,5);i.removeMenuItem&&i.removeMenuItem("image");i.addMenuItems&&i.addMenuItems({image:{label:i.lang.image.menu,command:n,group:"image"}})}})})()