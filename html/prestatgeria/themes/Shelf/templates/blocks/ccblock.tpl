
<!-- Inici d'un bloc central -->
<div class="center_inside">
    {if ! empty($title) }{* Només mostra el títol si existeix *}
    <h3>{$title}</h3>
    {/if}
    <div class="center_content">
        {$content}
    </div>
</div>
<!-- Final del bloc central -->

