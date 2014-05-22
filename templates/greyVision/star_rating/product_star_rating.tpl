{if $data['id_type'] != null}
    <div class="star">
        <div id="star_rating_{echo $data['id_type']}" class="productRate star-small">
            <div style="width: {echo $data['rating']."%"}"></div>
        </div>
    </div>
{/if}