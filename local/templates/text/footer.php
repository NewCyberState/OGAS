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
					<span class="navbar-text">
						&copy; 2020 <a href="/">ОГАС ДЕМО</a>
					</span>

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
