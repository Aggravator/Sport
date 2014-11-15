if (document.getElementsByClassName) {
    getElementsByClass = function (classList, node) {
        return (node || document).getElementsByClassName(classList)
    }
} else {
    getElementsByClass = function (classList, node) {
        var node = node || document,
		list = node.getElementsByTagName('*'),
		length = list.length,
		classArray = classList.split(/\s+/),
		classes = classArray.length,
		result = [], i, j
        for (i = 0; i < length; i++) {
            for (j = 0; j < classes; j++) {
                if (list[i].className.search('\\b' + classArray[j] + '\\b') != -1) {
                    result.push(list[i])
                    break
                }
            }
        }
        return result
    }
}
function addEvent(evnt, elem, func) {
   if (elem.addEventListener)  // W3C DOM
      elem.addEventListener(evnt,func,false);
   else if (elem.attachEvent) { // IE DOM
      elem.attachEvent("on"+evnt, func);
   }
   else { // No much to do
      elem[evnt] = func;
   }
}
if(window.utility===undefined)utility={}
utility.isIE=(function msieversion() {
	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");
	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))return true; else return false;
})();
if (utility.modalStack===undefined) utility.modalStack = {};
{
	(function(){
		var self=utility.modalStack;
		self.fone = document.createElement("div");
		self.fone.className="modal-stack-bg";
		self.fone.style.display="none";
		self.willHide=true;
		var coleWF=function(){
			if(utility.isIE){
				var target= (event.currentTarget) ? event.currentTarget : event.srcElement;
				if(target===self.fone && self.willHide){
					self.closeFunction();
				}
				else self.willHide=!self.willHide;
			}else{
				if(this===self.fone && self.willHide){
					self.closeFunction();
				}
				else self.willHide=!self.willHide;
			}				
		};
		addEvent("click",self.fone,coleWF);
		//self.fone.addEventListener("click",coleWF);
		self.frame=document.createElement("div");
		self.frame.className="modal-stack-content";
		addEvent("click",self.frame,coleWF);
		//self.frame.addEventListener("click",coleWF);
		self.fone.appendChild(self.frame);
		document.body.appendChild(self.fone);
		self.closeFunction=0;
		self.content=undefined;
		self.stack=new Array();
		self.show=function () {
			self.fone.style.display="";
			self.willHide=true;
			document.body.style.overflow="hidden";
		}
		self.hide = function () {
			self.fone.style.display="none";
		}
		self.setContent = function (obj,closeF) {
			if(self.content!=obj){
				if(obj.parentNode!=null)obj.parentNode.removeChild(obj);
				self.frame.appendChild(obj);
				obj.style.display = "block";
				if(self.content!==undefined){
					self.stack.push({obj:self.content,func: self.closeFunction});
					self.content.style.display="none";
				}
				self.content=obj;
				self.closeFunction=closeF;
			}
		}
		self.pop=function(){
			var objj=self.content;
			if(self.stack.length>=1){
				var obj=self.stack.pop();
				obj.obj.style.display="block";
				self.content=obj.obj;
				self.closeButton.onclick=obj.func;
				objj.parentNode.removeChild(objj);
			}else{
				self.hide();
				document.body.style.overflow="";
				objj.parentNode.removeChild(objj);
				self.content=undefined;
				self.closeFunction="";
			}
			return objj;
		}
	})();
    
}