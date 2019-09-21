let old_Y = window.pageYOffset;

window.onscroll = function () {
    let now_Y = window.pageYOffset;
    if (now_Y > old_Y) {
        document.getElementById('nav-bar').style.top = '-80px';
    }
    else {
        document.getElementById('nav-bar').style.top = '0px';
    }
    old_Y = now_Y;

    // Scoll Top
    if (document.documentElement.scrollTop > 200) {
        document.getElementById('scroll-top-btn').style.display = 'block';
    }
    else {
        document.getElementById('scroll-top-btn').style.display = 'none';
    }
}

document.getElementById('bg-music').volume = 0.05;