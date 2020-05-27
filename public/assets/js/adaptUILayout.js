/**
 * @file adaptUILayout & 返回按钮跳转 & toast
 * @version 1.0.0
 * @created on 2017/12/11
 * @author Keeva Jiang (keevajiang@126.com)
 */
(function (doc, win) {
    var baseWidth = 750;
    var baseFont = 40;
    var docEl = doc.documentElement,
        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        u = navigator.userAgent,
        isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
        recalc = function () {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
            if(clientWidth > 750) {
                clientWidth = 750;
            }
            docEl.style.fontSize = baseFont * (clientWidth / baseWidth) + 'px';

            /*处理安卓字体缩放*/
            if(isAndroid) {
                var $dom = document.createElement('div');
                $dom.style = 'font-size:30px;';
                document.body.appendChild($dom);
                // 计算出放大后的字体
                var scaledFontSize = parseFloat(window.getComputedStyle($dom, null).getPropertyValue('font-size'));
                document.body.removeChild($dom);
                // 计算原字体和放大后字体的比例
                var scaleFactor = 30 / scaledFontSize;
                // 取html元素的字体大小
                // 注意，这个大小也经过缩放了
                // 所以下方计算的时候 *scaledFontSize是原来的html字体大小
                // 再次 *scaledFontSize才是我们要设置的大小
                var originRootFontSize = parseFloat(window.getComputedStyle(document.documentElement, null).getPropertyValue('font-size'));
                document.documentElement.style.fontSize = originRootFontSize * scaleFactor * scaleFactor + 'px';
            }
        };
    if (!doc.addEventListener) return;
    win.addEventListener(resizeEvt, recalc, false);
    doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);


window.onload = function () {
    var backEle = document.getElementById('back');
    if(backEle) {
        backEle.addEventListener('click',backfun,false);
    }
    function backfun() {
        if(history.length > 1) {
            history.back();
        } else {
            location.href = '/front-mall/dist/index.html';
        }
    }
};

window.addEventListener("online", function () {
    location.reload();
});
window.addEventListener("offline", function () {
    toast('您的网络连接已断开，请联网后刷新');
});


function toast(msg) {
    var toastTag = document.getElementById('toast');
    if(!toastTag) {
        toastTag = document.createElement('div');
        toastTag.id = 'toast';
        toastTag.className = 'toast';
        document.body.appendChild(toastTag);
    }
    toastTag.className = 'toast';
    if(msg === 'loading') {
        msg = '<i class="load-icon iconfont icon-loading"></i> 加载中';
        toastTag.innerHTML = msg;
        toastTag.className = 'toast toastIn';
    } else if(msg === 'close' || !msg) {
        toastTag.className = 'toast toastOut';
    } else {
        toastTag.innerHTML = msg || ' ';
        setTimeout(function () {
            toastTag.className = 'toast toastAnimate';
        },100);
    }
}

/**/
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

