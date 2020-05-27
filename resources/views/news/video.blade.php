<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0,minimal-ui">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <meta name="x5-fullscreen" content="true">
    <meta name="full-screen" content="yes">
    <meta name="keywords" content="奇点汽车 资讯中心">
    <meta name="description" content="奇点汽车 资讯中心">
    <title>title - 视频详情</title>
    <link href="../assets/css/common.css?v2" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="page">
    <div class="news-box">
        <div class="content">
            <div class="quill-editor">
                <div class="ql-container ql-bubble">
                    <div class="ql-editor" id="content">
                        <!--内容开始-->
                        <p class="ql-cvideo">
                            <video preload="metadata" controls="controls" controlslist="nodownload"
                                   src="http://img0.singulato.com/video/im8.mp4"></video>
                        </p>
                        <!--内容结束-->
                        <div class="news-title">奇点汽车沈海寅：痛并爽着， 我的智能汽车</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="meta-content">
            <!-- data-id 为频道的id -->
            <a id="channel" data-id="xxx">
                <img class="photo" src="https://www.singulato.com/wp-content/themes/singulato/timthumb.php?src=https://www.singulato.com/wp-content/uploads/2017/05/640.jpg&w=140&h=100&q=100&zc=1"/>
            </a>
            <div class="channel-box">
                <span class="channel">奇点快讯</span>
                <div class="date">原创<span>2018.5.14</span></div>
            </div>
        </div>
        <div class="hot-comments">
            <h1>热门评论(1446)</h1>
            <!-- 有数据时显示 -->
            <div class="comments" id="comments">
                <div class="user-info">
                    <!-- data-id 为用户的id -->
                    <a id="user" data-id="xxx">
                        <img class="photo"
                             src="https://www.singulato.com/wp-content/themes/singulato/timthumb.php?src=https://www.singulato.com/wp-content/uploads/2017/05/640.jpg&w=140&h=100&q=100&zc=1"/>
                    </a>
                    <div class="user-box">
                        <span class="user">风之诗</span>
                        <div class="date"><span>3小时前</span></div>
                    </div>
                    <div class="user-box user-like">点赞<span>235</span></div>
                    <div class="user-comments">
                        <p>质量非常好，与卖家描述的完全一致，非常满意,真的很喜欢,完全超出期望值，发货速度非常快，包装非常仔细、严实，物流公司服务态度很好，运送速度很快，很满意的一次购物。</p>
                        <a href="https://www.baidu.com/">去APP查看3条回复 ></a>
                    </div>
                </div>
            </div>
            <!-- 无数据时显示 -->
            <div class="no-comments" id="no-comments">
                <div class="no-comments"><img src="../assets/images/no-comments.png" alt=""></div>
                <div class="no-comments-tip">暂无评论，快去APP抢沙发吧</div>
            </div>
        </div>
        <div class="footer" id="share">
            <a href="https://www.baidu.com/"> 打开奇点APP, 查看精彩评论 </a>
        </div>
    </div>
</div>
<script>
    // 获取像素
    function getPixel() {
        var oPhoto = document.querySelector(".news-box .photo"),
            top = oPhoto.offsetTop,
            height = oPhoto.offsetHeight;
        return [height, top];
    }
</script>
</body>
</html>
