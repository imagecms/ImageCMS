// Script edited by Szen. 
// Official editor site: http://szenprogs.ru
// In the script fixed buble position bugs.

$(function () {
  $('.bubbleInfo').each(function () {
    // options
    var distance = 10;
    var time = 250;
    var hideDelay = 500;
    var toppos, leftpos;

    var hideDelayTimer = null;

    // tracker
    var beingShown = false;
    var shown = false;
    
    var trigger = $('.trigger', this);
    var popup = $('.popup', this).css('opacity', 0);

    // set the mouseover and mouseout on both element
    $([trigger.get(0), popup.get(0)]).mouseover(function () {
      // stops the hide event if we move from the trigger to the popup element
      if (hideDelayTimer) clearTimeout(hideDelayTimer);

      // don't trigger the animation again if we're being shown, or already visible
      if (beingShown || shown) {
        return;
      } else {
        beingShown = true;
        
        //inserted by SzenProgs.ru        
        leftpos=(trigger.width()-popup.width())/2+trigger.position().left;
        toppos=-trigger.height()-popup.height();
        popup.css({top: toppos, left: leftpos, display: 'block'});
        if(popup.offset().left<0) leftpos=0;
        if(popup.offset().left+popup.width()+30>$(window).width()) leftpos=$(window).width()-popup.width()-30;
        if(popup.offset().top<0) toppos=trigger.position().top+trigger.height();
        //end SzenProgs.ru insert
        
        // reset position of popup box
        popup.css({
          top: toppos,
          left: leftpos,
          display: 'block' // brings the popup back in to view
        })

        // (we're using chaining on the popup) now animate it's opacity and position
        .animate({
          top: '-=' + distance + 'px',
          opacity: 1
        }, time, 'swing', function() {
          // once the animation is complete, set the tracker variables
          beingShown = false;
          shown = true;
        });
      }
    }).mouseout(function () {
      // reset the timer if we get fired again - avoids double animations
      if (hideDelayTimer) clearTimeout(hideDelayTimer);
      
      // store the timer so that it can be cleared in the mouseover if required
      hideDelayTimer = setTimeout(function () {
        hideDelayTimer = null;
        popup.animate({
          top: '-=' + distance + 'px',
          opacity: 0
        }, time, 'swing', function () {
          // once the animate is complete, set the tracker variables
          shown = false;
          // hide the popup entirely after the effect (opacity alone doesn't do the job)
          popup.css('display', 'none');
        });
      }, hideDelay);
    });
  });
});