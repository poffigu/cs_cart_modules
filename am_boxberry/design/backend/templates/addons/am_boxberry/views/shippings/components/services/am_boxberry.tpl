<fieldset>
    <div class="control-group">
        <label class="control-label" for="password">{__("am_boxberry.api_password")}</label>
        <div class="controls">
            <input id="password" type="text" name="shipping_data[service_params][password]" size="30" value="{$shipping.service_params.password}"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="boxberry_target_start">{__("am_boxberry.target_start")}</label>
        <div class="controls">
            <input id="margin_percent" type="text" name="shipping_data[service_params][boxberry_target_start]" size="30" value="{$shipping.service_params.boxberry_target_start}"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="default_weight">{__("am_boxberry.default_weight")}</label>
        <div class="controls">
            <input id="default_weight" type="text" name="shipping_data[service_params][default_weight]" size="30" value="{$shipping.service_params.default_weight}"/>
        </div>
    </div>
</fieldset>
