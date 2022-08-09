</div>
</div>
</div>
</div>
</div>
<!-- /content area -->


<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            ОГАС ДЕМО
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text  text-nowrap mr-2">
						&copy; 2020-<?=date("Y");?> <a href="/">ОГАС ДЕМО</a>
					</span>

        <a href="https://vk.com/digital_socialism/" target="_blank"><b class="fab fa-vk mr-2 mt-0 fa-1x font-weight-normal"></b></a>
        <a href="https://t.me/digitalsocialism" target="_blank"><b class="fab fa-telegram-plane mr-2 fa-1x font-weight-normal"></b></a>
        <a href="https://www.youtube.com/channel/UC9g23VIh4tRNf-dW7TdtWsg" target="_blank"><b class="fab fa-youtube mr-2 fa-1x font-weight-normal"></b></a>


        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "bottom",
            array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "bottom",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(),
                "MENU_CACHE_TIME" => "360000",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "N",
                "ROOT_MENU_TYPE" => "bottom",
                "USE_EXT" => "N",
                "COMPONENT_TEMPLATE" => "bottom"
            ),
            false
        ); ?>



    </div>
</div>
<!-- /footer -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
