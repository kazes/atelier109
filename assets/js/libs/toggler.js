/**
 * Created by stecov on 26/01/2015.
 * @version 1.0
 *
 * trigger:
 * <li class="JS_toggler" data-toggler-group="group" data-toggler-id="id">
 * available options:
 * data-toggler-action="open|close|close-all"
 *
 * receiver:
 * <div class="JS_item_toggler" data-toggler-group="group" data-toggler-itemid="id">
 * available options:
 * data-toggler-group-no-close="true"
 *
 */

var $allLinksToggler;
var selector = function (e) {
    console.log('accordion')
        console.log('utils:accordion:click', e);

    e.stopImmediatePropagation();//todo check how to improve this quick fix
    var $allLinksToggler = $('.JS_toggler');
    var $linkToggler = $(this);
    var action = e.type;
    var toggle = /click|toggle/.test(action);
    var opening = action === 'open' || $linkToggler.data('toggler-action') === 'open';
    var closing = action === 'close' || $linkToggler.data('toggler-action') === 'close';
    var closeAll = action === 'close-all' || $linkToggler.data('toggler-action') === 'close-all';

    var $allContents = $('.JS_item_toggler');
    var group = $linkToggler.data('toggler-group');
    var toggler_id = $linkToggler.data('toggler-id');
    var $content = $allContents.filter('[data-toggler-itemid=' + toggler_id + '][data-toggler-group=' + group + ']');
    var $contentGroup = closing ? $content : $allContents.filter('[data-toggler-group=' + group + ']');

    var isActive = opening ? !opening : closing ? closing : $content.hasClass('active');

    // Add remove classes
    if ($content.data('toggler-group-no-close') && !((toggle || opening || closing) && !isActive)) {
        return;
    }
    if (toggle || opening || closing || closeAll) {
        let $linksTogglerGroup = $allLinksToggler.filter('[data-toggler-group=' + group + ']');
        $linksTogglerGroup.removeClass('active');
        $contentGroup.filter('.active').removeClass('active').trigger('close');
    }
    if (!isActive && !closeAll) {
        let $linksTogglerGroup = $allLinksToggler.filter('[data-toggler-id=' + toggler_id + '][data-toggler-group=' + group + ']');
        $linksTogglerGroup.addClass('active');
        $content.addClass('active').trigger('open');
    }
};

var accordion = function () {

    $('body').on('click open close toggle', '.JS_toggler', selector);

};

export default accordion;