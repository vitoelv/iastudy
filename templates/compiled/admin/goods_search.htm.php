<!-- $Id: goods_search.htm 8201 2007-04-17 03:07:34Z weberliu $ -->
<div class="form-div">
  <form action="javascript:searchGoods()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php if ($_GET['act'] != "trash"): ?>
    <!-- 分类 -->
    <select name="cat_id"><option value="0"><?php echo $this->_var['lang']['goods_cat']; ?></option><?php echo $this->_var['cat_list']; ?></select>
    <!-- 品牌 -->
    <select name="brand_id"><option value="0"><?php echo $this->_var['lang']['goods_brand']; ?></option><?php echo $this->html_options(array('options'=>$this->_var['brand_list'])); ?></select>
    <!-- 推荐 -->
    <select name="intro_type"><option value="0"><?php echo $this->_var['lang']['intro_type']; ?></option><?php echo $this->html_options(array('options'=>$this->_var['intro_list'],'selected'=>$_GET['intro_type'])); ?></select>
    <?php endif; ?>
    <!-- 关键字 -->
    <?php echo $this->_var['lang']['keyword']; ?> <input type="text" name="keyword" size="15" />
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>


<script language="JavaScript">
    function searchGoods()
    {

        <?php if ($_GET['act'] != "trash"): ?>
        listTable.filter['cat_id'] = document.forms['searchForm'].elements['cat_id'].value;
        listTable.filter['brand_id'] = document.forms['searchForm'].elements['brand_id'].value;
        listTable.filter['intro_type'] = document.forms['searchForm'].elements['intro_type'].value;
        <?php endif; ?>

        listTable.filter['keyword'] = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
        listTable.filter['page'] = 1;

        listTable.loadList();
    }
</script>
