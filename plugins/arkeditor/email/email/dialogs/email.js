"use strict";
/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
(function(){CKEDITOR.dialog.add("email",function(n){var i=CKEDITOR.plugins.link,t=n.lang.link;return{title:t.toEmail,minWidth:350,minHeight:230,contents:[{id:"info",label:t.info,title:t.info,elements:[{type:"vbox",id:"emailOptions",padding:1,children:[{type:"text",id:"emailAddress",label:t.emailAddress,required:!0,validate:function(){var i=this.getDialog(),n=CKEDITOR.dialog.validate.notEmpty(t.noEmail);return n.apply(this)},setup:function(n){n.email&&this.setValue(n.email.address)},commit:function(n){n.email||(n.email={});n.email.address=this.getValue()}},{type:"text",id:"emailSubject",label:t.emailSubject,setup:function(n){n.email&&this.setValue(n.email.subject)},commit:function(n){n.email||(n.email={});n.email.subject=this.getValue()}},{type:"textarea",id:"emailBody",label:t.emailBody,rows:3,"default":"",setup:function(n){n.email&&this.setValue(n.email.body)},commit:function(n){n.email||(n.email={});n.email.body=this.getValue()}}]}]},],onShow:function(){var t=this.getParentEditor(),r=t.getSelection(),n=null,u;(n=i.getSelectedLink(t))&&n.hasAttribute("href")?r.getSelectedElement()||r.selectElement(n):n=null;u=i.parseLinkAttributes(t,n);this._.selectedElement=n;this.setupContent(u)},onOk:function(){var t={type:"email"},e,r,u,o,s;if(this.commitContent(t),e=n.getSelection(),r=i.getLinkAttributes(n,t),this._.selectedElement){var f=this._.selectedElement,c=f.data("cke-saved-href"),h=f.getHtml();f.setAttributes(r.set);f.removeAttributes(r.removed);(c==h||t.type=="email"&&h.indexOf("@")!=-1)&&(f.setHtml(t.type=="email"?t.email.address:r.set["data-cke-saved-href"]),e.selectElement(f));delete this._.selectedElement}else u=e.getRanges()[0],u.collapsed&&(o=new CKEDITOR.dom.text(t.type=="email"?t.email.address:r.set["data-cke-saved-href"],n.document),u.insertNode(o),u.selectNodeContents(o)),s=new CKEDITOR.style({element:"a",attributes:r.set}),s.type=CKEDITOR.STYLE_INLINE,s.applyToRange(u,n),u.select()},onLoad:function(){}}})})();
/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
(function(){CKEDITOR.dialog.add("email",function(n){var i=CKEDITOR.plugins.link,t=n.lang.link;return{title:t.toEmail,minWidth:350,minHeight:230,contents:[{id:"info",label:t.info,title:t.info,elements:[{type:"vbox",id:"emailOptions",padding:1,children:[{type:"text",id:"emailAddress",label:t.emailAddress,required:!0,validate:function(){var i=this.getDialog(),n=CKEDITOR.dialog.validate.notEmpty(t.noEmail);return n.apply(this)},setup:function(n){n.email&&this.setValue(n.email.address)},commit:function(n){n.email||(n.email={});n.email.address=this.getValue()}},{type:"text",id:"emailSubject",label:t.emailSubject,setup:function(n){n.email&&this.setValue(n.email.subject)},commit:function(n){n.email||(n.email={});n.email.subject=this.getValue()}},{type:"textarea",id:"emailBody",label:t.emailBody,rows:3,"default":"",setup:function(n){n.email&&this.setValue(n.email.body)},commit:function(n){n.email||(n.email={});n.email.body=this.getValue()}}]}]},],onShow:function(){var t=this.getParentEditor(),r=t.getSelection(),n=null,u;(n=i.getSelectedLink(t))&&n.hasAttribute("href")?r.getSelectedElement()||r.selectElement(n):n=null;u=i.parseLinkAttributes(t,n);this._.selectedElement=n;this.setupContent(u)},onOk:function(){var t={type:"email"},e,r,u,o,s;if(this.commitContent(t),e=n.getSelection(),r=i.getLinkAttributes(n,t),this._.selectedElement){var f=this._.selectedElement,c=f.data("cke-saved-href"),h=f.getHtml();f.setAttributes(r.set);f.removeAttributes(r.removed);(c==h||t.type=="email"&&h.indexOf("@")!=-1)&&(f.setHtml(t.type=="email"?t.email.address:r.set["data-cke-saved-href"]),e.selectElement(f));delete this._.selectedElement}else u=e.getRanges()[0],u.collapsed&&(o=new CKEDITOR.dom.text(t.type=="email"?t.email.address:r.set["data-cke-saved-href"],n.document),u.insertNode(o),u.selectNodeContents(o)),s=new CKEDITOR.style({element:"a",attributes:r.set}),s.type=CKEDITOR.STYLE_INLINE,s.applyToRange(u,n),u.select()},onLoad:function(){}}})})()