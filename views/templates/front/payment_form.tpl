{capture name=path}
    <a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}" title="{l s='Go back to the Checkout' mod='bankwire'}">{l s='Checkout' mod='bankwire'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Bank-wire payment' mod='bankwire'}
{/capture}

{include file="$tpl_dir./breadcrumb.tpl"}

<h2>{l s='Mercury Payment' mod='bankwire'}</h2>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{if $nbProducts <= 0}
    <p class="warning">{l s='Your shopping cart is empty.' mod='bankwire'}</p>
{else}

    <h3>{l s='Mercury payment' mod='mercurycash'}</h3>

    <form action="{$action}" id="mercury-payment-form">
        <input type="hidden" name="refresh_period" value="{$refresh_period}">
        <input type="hidden" name="url" value="{$url}">
        <input type="hidden" name="static_url" value="{$modules_dir}">
        <input type="hidden" name="status_url" value="{$status_url}">
        <input type="hidden" name="get_settings_url" value="{$get_settings_url}">
        <input type="hidden" name="success_url" value="{$success_url}">
        <p class="cart_navigation" id="cart_navigation">
            <input type="submit" value="{l s='I confirm my order' mod='mercurycash'}" class="exclusive_large" />
            <a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html'}" class="button_large">{l s='Other payment methods' mod='mercurycash'}</a>
        </p>
    </form>
    <div class="loader-modal"></div>
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" style="margin: 0 auto;" id="errorModalLabel"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
{/if}