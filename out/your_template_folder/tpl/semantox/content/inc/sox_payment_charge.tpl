
[{foreach from=$oView->soxGetNotMappedPayments() item=oNewPaymentMethod}]
	<div about="[{$sSoxUrl}]#[{$oNewPaymentMethod->cleanid->value}]" typeof="gr:PaymentMethod">
		<div property="rdfs:label" content="[{$oNewPaymentMethod->label->value}]"></div>
[{if $oNewPaymentMethod->comment->value != ""}]
		<div property="rdfs:comment" content="[{$oNewPaymentMethod->comment->value}]"></div>
[{/if}]
	</div>
[{/foreach}]
