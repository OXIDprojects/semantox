		<div rel="gr:includes">
[{if $oView->getVariantList() || $oView->drawParentUrl()}]
			<div typeof="gr:ProductOrServiceModel" about="[{$sSoxUrl}]#productdata">
[{else}]
			<div typeof="gr:SomeItems" about="[{$sSoxUrl}]#productdata">
[{/if}]
[{if $sSoxName}] 
				<div property="gr:name" content="[{$sSoxName}]" [{if $sSoxLanguage}] xml:lang="[{$sSoxLanguage}]"[{/if}]></div>
[{/if}]
[{oxhasrights ident="SHOWLONGDESCRIPTION"}]
[{if $sSoxLongDesc}]
				<div property="gr:description" content="[{$sSoxLongDesc}]" [{if $sSoxLanguage}] xml:lang="[{$sSoxLanguage}]"[{/if}]></div>
[{/if}]
[{/oxhasrights}]
				<div rel="foaf:depiction v:image" resource="[{$oView->getActPicture()}]"></div>
				<div property="gr:hasStockKeepingUnit" content="[{$oProduct->oxarticles__oxartnum->value}]" datatype="xsd:string"></div>
[{if $oProduct->oxarticles__oxmpn->value}]
				<div property="gr:hasMPN" content="[{$oProduct->oxarticles__oxmpn->value}]" datatype="xsd:string"></div>
[{/if}]
[{if $oView->soxGetEan()}]
				<div property="gr:hasEAN_UCC-13" content="[{$oView->soxGetEan()}]" datatype="xsd:string"></div>
[{/if}]
[{if $oView->soxGetGenericCondition()}]
				<div property="gr:condition" content="[{$oView->soxGetGenericCondition()}]" xml:lang="en"></div>
[{/if}]
[{foreach from=$oView->getCatTreePath() item=oCatPath name="detailslocation"}]
[{if $smarty.foreach.detailslocation.last}]
				<div property="gr:category" content="[{$oCatPath->oxcategories__oxtitle->value|strip_tags}]" [{if $sSoxLanguage}] xml:lang="[{$sSoxLanguage}]"[{/if}]></div>
[{/if}]
[{/foreach}]
[{foreach from=$oView->soxGetSize() item=sValue key=sProperty}]
				<div rel="gr:[{$sProperty}]">
					<div typeof="gr:QuantitativeValue">
						<div property="gr:hasValue" content="[{$sValue}]" datatype="xsd:float"></div>
						<div property="gr:hasUnitOfMeasurement" content="MTR" datatype="xsd:string"></div>
					</div>
				</div>
[{/foreach}]
[{if $oProduct->oxarticles__oweight->value}]
				<div rel="gr:weight">
					<div typeof="gr:QuantitativeValue">
						<div property="gr:hasValue" content="[{$oProduct->oxarticles__oweight->value}]" datatype="xsd:float"></div>
						<div property="gr:hasUnitOfMeasurement" content="KGM" datatype="xsd:string"></div>
					</div>
				</div>
[{/if}]
			</div>
		</div>
[{if $oView->soxGetBundleUri()}]		
		<div rel="gr:includes" resource="[{$oView->soxGetBundleUri()}]#productdata"></div>
[{/if}]