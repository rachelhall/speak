jQuery(document).ready((function(e){function t(t){return tb_show("","media-upload.php?TB_iframe=true"),window.send_to_editor=function(a){var i=e("img",a),o=i.context.substring(i.context.indexOf("wp-image-")+9,i.context.lastIndexOf('"')),r=i.context.substring(i.context.indexOf('src="')+5,i.context.indexOf('" alt="'));e(t).val(o),e(t).siblings(".remove-image").remove(),e(t).after('<div class="remove-image" style="background-image:url(\''+r+'\');" title="remove image"><i class="material-icons">close</i></div>'),tb_remove(),window.send_to_editor=n},!1}function a(t){for(var a=!0,i=0;i<t.length;i++){var n=t[i].selector,o=t[i].value,r=t[i].relation;e(n).length>0&&("is"==r?e(n).is(o)||(a=!1):"isnot"==r?e(n).is(o)&&(a=!1):">"==r?e(n).val()<=o&&(a=!1):">="==r?e(n).val()<o&&(a=!1):"<"==r?e(n).val()>=o&&(a=!1):"<="==r?e(n).val()>o&&(a=!1):"!"==r||"!="==r||"!=="==r?e(n).val()==o&&(a=!1):"="!=r&&"=="!=r&&"==="!=r||e(n).val()!==o&&(a=!1))}return a}e("#company-address-zip").inputmask("99999");var i,n=window.send_to_editor;e(".speak-meta-box").on("click",".attach-image",(function(){t(i=e(this).siblings("input"))})),e(".speak-meta-box").on("click",".remove-image",(function(){e(this).siblings("input").val(""),e(this).remove()})),e(".speak-meta-repeater").on("click",".add-repeater-row",(function(){var t=e(this).next(".repeater-clone").html(),a=e(this).prev("fieldset").find(".repeater-row").length>0?parseFloat(e(this).prev("fieldset").find(".repeater-row").last().attr("data-index"))+1:0;t=t.split("replace_index").join(a),e(this).prev("fieldset").children(".repeater-rows").append('<li class="repeater-row sort-item" data-index="'+a+'">'+t+"</li>")})),e(".speak-meta-repeater").on("click",".remove-row-btn",(function(){confirm("Are you sure you wish to permanently delete this row?")&&e(this).parents(".repeater-row").remove()})),e(".speak-sortable").sortable({items:"> .sort-item",cursor:"grabbing",handle:".sort-handle"});var o=[];e(".speak-conditions").each((function(){for(var t=e.parseJSON(e(this).text()),a=0;a<t.length;a++)-1==e.inArray(t[a].selector,o)&&o.push(t[a].selector)})),e(window).load((function(){for(var t=0;t<o.length;t++)e(".speak-conditions:contains("+o[t]+")").each((function(){var t,i;!1===a(e.parseJSON(e(this).text()))&&e(this).closest(".speak-toggleable").addClass("hddn")}))}));for(var r=0;r<o.length;r++)!function(t){e("body").on("change",t,(function(){e(".speak-conditions:contains("+t+")").each((function(){var t,i;!1===a(e.parseJSON(e(this).text()))?e(this).closest(".speak-toggleable").addClass("hddn"):e(this).closest(".speak-toggleable").removeClass("hddn")}))}))}(o[r])}));