mwf.messages=function(){};mwf.messages.modal=function(a){(function(h){var f=h.extend({id:null,text:null,type:null,padded:true,callback:null},a);if(f.id==null){if(f.text==null){console.error("The text parameter must be specified");return}if(f.type==null){console.error("The type parameter must be specified");return}if(f.type!=null){f.type=f.type.toLowerCase();if(f.type!="alert"&&f.type!="confirm"&&f.type!="error"&&f.type!="info"){console.error('Invalid type parameter.  Must be "alert", "confirm", "error" or "info"');return}}if(f.callback!=null){if(typeof(f.callback)!="function"){console.error("Callback "+f.callback+" is not a function");return}}}var e;if(f.id==null){if(f.text==null){throw"Text parameter must be specified"}e+='<div class="message ';e+=f.type;if(!f.padded){e+=" not-padded"}e+='">';e+=f.text;e+="</div>"}else{e="#"+f.id}var g=h(e);if(g==null){console.error("Cannot find element");return}if(g.hasClass("not-padded")){f.padded=false}var c=h('<div class="message-mask" />');var b="message-button button";if(!f.padded){b+=" not-padded"}var d=h('<div class="'+b+'"><a href="#">OK</a></div>');g.detach();g.addClass("message-modal");g.prependTo("body");g.before(c);g.wrap('<div class="message-wrapper" />');g.after(d);d.click(function(i){i.preventDefault();g.parent(".message-wrapper").remove();c.remove();if(f.callback!=null){f.callback()}})})(jQuery)};