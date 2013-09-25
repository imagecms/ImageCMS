{ if $paid}
    {lang('Congratulations! You can download this digital content!', 'digital_products')}
    <br />
    { anchor($link)}
{ else:}
    {lang('You must pay to download this digital content.', 'digital_products')}
{ /if}