<div class="blocContent">
    {foreach item=book from=$books}
    <div class="blocLink" style="width: 100%">
        <a href="#" onclick="javascript:showBookData({$book.bookId})">
            {$book.bookTitle}
        </a>
    </div>
    {/foreach}
    <div style="clear:both;"></div>
</div>
