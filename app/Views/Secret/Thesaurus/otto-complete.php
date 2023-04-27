<div class="col-lg-6">
    <label for="<?=$this->e($reference)?>" class="col-form-label">
        <?=$this->e($label)?>: 
        <span><?php if(!empty($value) && isset($unesco_authorities) && isset($unesco_authorities[$value])) echo $unesco_authorities[$value]->get('label'); ?></span>
    </label>
</div>

<div class="col-lg">
    <input 
        type="search" placeholder="Modifier"
        
        class="form-control otto-complete" 
        
        data-filter-on="thesaurus.label"
        data-filter-to="<?=$this->e($reference)?>"
        data-return="id,label"
        />
    <input type="hidden" id="<?=$this->e($reference)?>" name="<?=$this->e($reference)?>" value="<?= $this->e($value)?>" />
    <div id="<?=$this->e($reference)?>-suggestions"></div>
</div>