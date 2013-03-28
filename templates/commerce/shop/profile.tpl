<div class="main_body">
    <div class="content">
        <div class="center">
            <h1>{lang("Private office")}</h1>
            <div  class="msg_form_edit">
                {if $errors}
                    <div class="msg_form_edit_prof">
                        {echo $errors}
                    </div>
                {/if}</div>
            <div class="personal_info f_l">
                <div class="block_title_18"><span class="title_18">{lang("My Account")}</span></div>
                <ul>
                    <li>
                        <span>{lang("You name")}:</span>
                        <b>{echo encode($profile->getName())}</b>
                    </li>
                    <li>
                        <span>{lang("E-mail Address")}:</span>
                        <b>{echo encode($profile->getUserEmail())}</b>
                    </li>
                    <li>
                        <span>{lang("Phone")}:</span>
                        <b>{echo encode($profile->getPhone())}</b>
                    </li>
                    <li>
                        <span>{lang("Address for service")}:</span>
                        <b>{echo encode($profile->getAddress())}</b>
                    </li>
                </ul>
                    
                <a href="{shop_url('/cart')}" class="f_r w-s_n-w">{lang("Go to basket")}</a>
                <a href="{shop_url('wish_list')}"  style="margin-right:9px;" class="f_l w-s_n-w" >{lang("View Wishlist")}</a><br />
                <a href="#" class="f_r w-s_n-w" id="user_form">{lang("Edit personal information")}</a>
                <a href="#" class="f_l w-s_n-w" id="change_password">{lang("Change Password")}</a>


                <div class="fancy c_b" style="border: none; display: none;" id="change_password_fields">
                    <form action="{shop_url('profile')}" method="post" name="editFormpass" style="padding-left: 0;">
                        <div id="change_info_edit">
                            <h3>{lang("Change Password")}</h3>
                            <label>{lang("Old Password")}:
                                <input type="password" class="required" name="old_password">
                            </label>
                            <label> {lang("The new password")}:
                                <input type="password" class="required" name="password">
                            </label>
                            <label>{lang("Confirm new password")}:
                                <input type="password" class="required" name="confirm_new_password">
                            </label>

                            <div id="buttons">
                                <div class="p-t_19 c_b clearfix" style="width: 191px;">
                                    <div class="buttons button_middle_blue f_r">
                                        <input type="hidden" value="1" name="cangePassword" />
                                        <a href="#" id="checkout" onClick="document.editFormpass.submit();">{echo ShopCore::t(lang("Save"))}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {form_csrf()}
                    </form>
                </div>

                <div class="fancy c_b" style="border: none; display: none;" id="change_user_fields">
                    <form action="{shop_url('profile')}" method="post" name="editForms" style="padding-left: 0;">
                        <div id="change_info_edit">

                            <h3>{lang("Edit personal information")}</h3>
                            <label>{lang("Name and surname")}:
                                <input type="text" class="required" value="{echo encode($profile->getName())}" name="name"/>
                            </label>
                            <label>{lang("Email")}:
                                <input type="text" class="required" value="{echo encode($profile->getUserEmail())}" name="email"/>
                            </label>                          
                            <label>{lang("Address")} {lang("Delivery")}:
                                <input type="text" class="required" value="{echo encode($profile->getAddress())}" name="address"/>
                            </label>
                            <label> {lang("Phone")}:
                                <input type="text" class="required" value="{echo encode($profile->getPhone())}" name="phone"/>
                            </label>

                            <div id="buttons">
                                <div class="p-t_19 c_b clearfix"  style="width: 191px;">
                                    <div class="buttons button_middle_blue f_r">
                                        <input type="hidden" value="1" name="changeName"/>
                                        <input type="submit" id="checkout"  value="{lang("Save")}"/>
                                    </div>
                                </div>
                            </div>                                    
                        </div>
                        {form_csrf()}
                </div>
                </form>
            </div> 

            <div class="history_order f_r">
                <div class="block_title_18"><span class="title_18">{lang("Order History")}</span></div>

                {lang("In")} {lang("Cart")}:
                <span style="font-weight: bold;">
                    {echo ShopCore::app()->SCart->totalItems()}
                    {echo SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array(lang("product"), lang("product"), lang("product")))}
                </span>
                <table cellspacing="0">
                    <colgroup>
                        <col span="1" width="79">
                        <col span="1" width="88">
                        <col span="1" width="70">
                        <col span="1" width="119">
                        <col span="1" width="119">
                        <col span="1" width="89">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>{lang("Payment")}</th>
                            <th>{lang("Status")}</th>
                            <th>{lang("Created")}</th>
                            <th>{lang("Updated")}</th>
                            <th>{lang("Total")}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {foreach $orders as $order}
                                <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">{echo $order->getId()}</a></td>
                                <td>{if $order->getPaid()}{lang("Yes")} {else:} {lang("No")} {/if}</td>
                                <td>{echo SOrders::getStatusName('Id', $order->getStatus())}</td>
                                <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                                <td>{date("d-m-Y H:i", $order->getDateUpdated())}</td>
                                <td>{echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())} {$CS}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>

            <div class="history_order f_r">
                <div class="block_title_18"><span class="title_18">{lang("Do you follow the following goods")}</span></div>

                {lang("Goods in order to monitor")}:
                <span style="font-weight: bold;">
                    {echo count($goodsInSpy)}
                </span>
                {if count($goodsInSpy)>0}
                    <table cellspacing="0">
                        <thead>
                            <tr>
                                <th>{lang("Item Number")}</th>
                                <th>{lang("Product Name")}</th>
                                <th>{lang("Difference")}</th>
                                <th>{lang("Differencein percents")}</th>
                                <th>{lang("Unsubscribe")}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $goodsInSpy as $good}
                                {$product = $good->getProduct()}
                                <tr>
                                    <td>{echo $product[0]->getId()}</td>
                                    <td><a href="{$BASE_URL}shop/product/{echo $product[0]->getUrl()}">{echo $product[0]->getName()}</td>
                                    <td>
                                        {echo $good->getdist()}
                                    </td>
                                    <td>
                                        {echo $good->getpercentdist()}
                                    </td>
                                    <td>
                                        <a href="{echo $good->getLink()}">{lang("Unsubscribe")}</a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {/if}
            </div>
        </div>
        <div class="center">
        </div>
    </div></div>



{literal}
    <script>
        $("#change_password").click(function () {
            $("#change_password_fields").slideToggle();
            $("#change_user_fields").hide();
        });

        $("#user_form").click(function () {
            $("#change_password_fields").hide();
            $("#change_user_fields").slideToggle();
        });
    </script>
{/literal}