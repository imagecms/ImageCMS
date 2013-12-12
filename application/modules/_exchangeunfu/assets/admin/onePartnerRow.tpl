<tr data-partnerId="{echo $partner['id']}">
    <td class="countPartners">
        {echo $partner['count']}
    </td>
    <td>
        <div class="name">{echo $partner['name']}</div>
        <input type="text" class="name" style="display: none"/>
    </td>
    <td>
        <div class="prefix">{echo $partner['prefix']}</div>
        <input type="text" class="prefix" style="display: none"/>
    </td>
    <td>
        <div class="code">{echo $partner['code']}</div>
        <input type="text" class="code" style="display: none"/>
    </td>
    <td>
        <div class="region">{echo $partner['region']}</div>
        <input type="text" class="region" style="display: none"/>
    </td>
    <td class="span1">
        <button type="button" class="btn btn-small btn-success partnerRefresh">
            <i class="icon-edit"></i></button>
        <button type="button" class="btn btn-small btn-success partnerUpdate" style="display: none">
            <i class="icon-refresh"></i></button>
    </td>
    <td class="span1">
        <button type="button" class="btn btn-small action_on btn-danger deletePartner">
            <i class="icon-trash"></i></button>
    </td>

</tr>