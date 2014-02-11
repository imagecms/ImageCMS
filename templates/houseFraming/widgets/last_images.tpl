<div class="projects">
    <h3>{lang('Projects', 'houseFraming')}</h3>
    <div class="project_img">        
        {foreach $images as $image}
            <img src="/{$image.file_path}" />
            {/foreach}        
    </div>
</div>