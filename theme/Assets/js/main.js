
$('.utilities-list-item li a').on('click', function (e) {
    e.preventDefault();
    var id = this.id;
    var num = id.substring(8, 10);
    $('.utiliti-content-wrap').removeClass('utiliti-content-active');
    $('#utiliti-content-' + num).addClass('utiliti-content-active');
});

$('.icon-utilitis-wrap a').on('click', function () {
    $('.icon-utilitis-wrap a').removeClass('active');
    $(this).addClass('active');
});

$('#list-icon-utilitis li').click(function (i) {
    jQuery('#list-icon-utilitis').removeClass('active')

    let index = $('#list-icon-utilitis li').index(this) + 1;
    let itemCounter = parseInt($('.utilities-list-item ul li').length);

    if(parseInt(index) <= itemCounter / 2){
        $(this).parent().find('li:last-child').prependTo("#list-icon-utilitis ul");
        $(this).parent().find('li:nth-child(1)').css({
            'transform': 'rotate(0deg)'
        });
        jQuery('#list-icon-utilitis').addClass('active')
        setTimeout(function () {
            SpinCircleStart();
        }, 100);
    }else{
        $(this).parent().find('li:first-child').css({
            'transform': 'rotate(179.99deg)'
        });
        jQuery('#list-icon-utilitis').addClass('active')
        $(this).parent().find('li:first-child').appendTo("#list-icon-utilitis ul");
        setTimeout(function () {
            SpinCircleStart();
        }, 100);
    }
});

function SpinCircleStart() {
    let deg = 25.7;
    let endDeg = 154.29;
    let itemCounter = parseInt($('.utilities-list-item ul li').length);
    let stepDeg = (endDeg - deg) / (itemCounter - 1);
    let lineDeg = stepDeg/2;

    $('.utilities-list-item ul li').find('.line-item-middle-before').attr('style',`transform: rotate(-${lineDeg}deg)`)
    $('.utilities-list-item ul li').find('.line-item-middle-after').attr('style',`transform: rotate(${lineDeg}deg)`)
    for(let i = 1; i <= itemCounter; i++){
        $('.utilities-list-item ul li:nth-child('+i.toString()+')').css({
            '-webkit-transform': 'rotate('+deg+'deg)',
            '-moz-transform': 'rotate('+deg+'deg)',
            '-ms-transform': 'rotate('+deg+'deg)',
            '-o-transform': 'rotate('+deg+'deg)',
            'transform': 'rotate('+deg+'deg)'
        });
        deg += stepDeg;
    }
  }
SpinCircleStart()