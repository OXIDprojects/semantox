<?php

/**
 * Copyright (C) 2011 Daniel Bingel 
 *
 * This file is part of Semantox module for OXID eShop.
 * 
 * Semantox is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Semantox is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Semantox. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://code.google.com/p/semantox/
 */

$sLangName  = "English";
$aLang =  array(
'charset'						=>	'UTF-8',

'SOX_MENU_SEMANTOX'				=>	'Semantox',

'SOX_SHOP_TECH_CONFIG'			=>	'Technische Einstellungen',
'SOX_SHOP_MOD_MARKUP'			=>	'Markup modifizieren',
'SOX_SHOP_EMBEDDING'			=>	'Einbettung der Daten',
'SOX_SHOP_AUTO_EMBEDDING'		=>	'Automatische Einbettung konfigurieren',
'SOX_SHOP_CONTENT_OFFERER'		=>	'In welche Content-Seite sollen die RDF-Daten des <b>Anbieters</b> eingebettet werden?',
'SOX_SHOP_CONTENT_PAYMENT'		=>	'In welche Content-Seite sollen die RDF-Daten der <b>Zahlungsarten</b> eingebettet werden?',
'SOX_SHOP_CONTENT_DELIVERY'		=>	'In welche Content-Seite sollen die RDF-Daten der <b>Versandmethoden</b> eingebettet werden?',
'SOX_SHOP_RATING'				=>	'Mit wie vielen Punkten können Kunden einen Artikel minimal und maximal bewertet werden?',
'SOX_SHOP_RATING_MIN'			=>	'<b>Minimale</b> Punktzahl',
'SOX_SHOP_RATING_MAX'			=>	'<b>Maximale</b> Punktzahl',
'SOX_SHOP_DATA_OFFERER'			=>	'Anbieterdaten',
'SOX_SHOP_DATA_MASTER'			=>	'Stammdaten',
'SOX_SHOP_DATA_EXTENDED'		=>	'Erweiterte Anbieterdaten',
'SOX_SHOP_LOGO_URL'				=>	'Logo-URL',
'SOX_SHOP_GEO'					=>	'Geo-position',
'SOX_SHOP_LONGITUDE'			=>	'Longitude',
'SOX_SHOP_LATITUDE'				=>	'Latitude',
'SOX_SHOP_GLN'					=>	'GLN',
'SOX_SHOP_NAICS'				=>	'NAICS',
'SOX_SHOP_ISIC'					=>	'ISIC',
'SOX_SHOP_DUNS'					=>	'D-U-N-S',
'SOX_SHOP_GLOBAL_OFFERING_DATA'	=>	'Globale Angebotsdaten',
'SOX_SHOP_VAT'					=>	'Sind die dem Kunden angezeigten Preise <b>inkl.</b> oder <b>exkl.</b> der <b>gesetzlichen MwSt.</b>?',
'SOX_SHOP_VAT_INC'				=>	'inkl. MwSt.',
'SOX_SHOP_VAT_EX'				=>	'exkl. MwSt.',
'SOX_SHOP_COND'					=>	'Wie ist der <b>Zustand</b> der angebotenen Artikeln?',
'SOX_SHOP_COND_NEW'				=>	'new',
'SOX_SHOP_COND_USED'			=>	'used',
'SOX_SHOP_COND_REFURBISHED'		=>	'refurbished',
'SOX_SHOP_FNC'					=>	'Welche <b>Funktion</b> erfüllen Ihre Angebote?',
'SOX_SHOP_FNC_SELL'				=>	'Sell',
'SOX_SHOP_FNC_LEASEOUT'			=>	'Lease out',
'SOX_SHOP_FNC_REPAIR'			=>	'Repair',
'SOX_SHOP_FNC_MAINTAIN'			=>	'Maintain',
'SOX_SHOP_FNC_CONSTINST'		=>	'Construction/Installation',
'SOX_SHOP_FNC_SERVICE'			=>	'Provide service',
'SOX_SHOP_FNC_DISPOSE'			=>	'Dispose',
'SOX_SHOP_FNC_NONE'				=>	'Keine der vorhandenen',
'SOX_SHOP_COSTUMER'				=>	'Welche <b>Konsumentengruppen</b> werden in Ihren Angeboten angesprochen?',
'SOX_SHOP_COSTUMER_ENDUSER'		=>	'Endverbraucher',
'SOX_SHOP_COSTUMER_RESELLER'	=>	'Wiederverkäufer',
'SOX_SHOP_COSTUMER_BUSINESS'	=>	'Unternehmen/Gewerbetreibende',
'SOX_SHOP_COSTUMER_PUBLIC'		=>	'Öffentliche Einrichtungen',
'SOX_SHOP_DURATION'				=>	'Welche <b>Gültigkeitsdauer</b> haben Ihre <b>Angebote</b> und <b>Angebotspreise</b>?',
'SOX_SHOP_OFFERINGS'			=>	'Angebote',
'SOX_SHOP_PRICES'				=>	'Angebotspreise',
'SOX_SHOP_1_DAY'				=>	'1 day',
'SOX_SHOP_7_DAYS'				=>	'7 days (1 week)',
'SOX_SHOP_14_DAYS'				=>	'14 days (2 weeks)',
'SOX_SHOP_30_DAYS'				=>	'30 days (1 month)',
'SOX_SHOP_178_DAYS'				=>	'178 days (6 months)',
'SOX_SHOP_356_DAYS'				=>	'356 days (1 year)',

'SOX_PAYMENT_ASIGN_PAYMENT'		=>	'Zahlungsart zuordnen',
'SOX_PAYMENT_ADVICE_START'		=>	'<b>Hinweis:</b> Bitte wählen Sie von den folgenden, in GoodRelations vordefinierten Zahlungsarten nur diejenigen aus, die der Zahlungsart',
'SOX_PAYMENT_ADVICE_END'		=>	'entsprechen',
'SOX_PAYMENT_GENERAL'			=>	'General payment methods',
'SOX_PAYMENT_CASH'				=>	'Cash',
'SOX_PAYMENT_GOOGLECHECKOUT'	=>	'Google Checkout',
'SOX_PAYMENT_DIRECTDEBIT'		=>	'Direct debit',
'SOX_PAYMENT_COD'				=>	'Cash on delivery',
'SOX_PAYMENT_PAYPAL'			=>	'PayPal',
'SOX_PAYMENT_PAYSWARM'			=>	'PaySwarm',
'SOX_PAYMENT_INVOICE'			=>	'Invoice',
'SOX_PAYMENT_CHECKIA'			=>	'Check in advance',
'SOX_PAYMENT_BANKTRANSFERIA'	=>	'Cash in advance',
'SOX_PAYMENT_CREDITCARD'		=>	'Credit card payment',
'SOX_PAYMENT_AMERICANEXPRESS'	=>	'American Express',
'SOX_PAYMENT_DINERSCLUB'		=> 	'Diners Club',
'SOX_PAYMENT_DISCOVER'			=>	'Discover',
'SOX_PAYMENT_JCB'				=>	'JCB',
'SOX_PAYMENT_MASTERCARD'		=>	'MasterCard',
'SOX_PAYMENT_VISA'				=>	'VISA',

'SOX_DELIVERY_ASIGN_DELIVERY'	=>	'Versandarten zuordnen',
'SOX_DELIVERY_ADVICE_START'		=>	'<b>Hinweis:</b> Bitte wählen Sie von den folgenden, in GoodRelations vordefinierten Versandarten nur diejenigen aus, die der Versandart',
'SOX_DELIVERY_ADVICE_END'		=>	'entsprechen',
'SOX_DELIVERY_GENERAL'			=>	'General delivery methods',
'SOX_DELIVERY_DOWNLOAD'			=>	'Download',
'SOX_DELIVERY_OWNFLEET'			=>	'Own fleet',
'SOX_DELIVERY_MAIL'				=>	'Mail',
'SOX_DELIVERY_PICKUP'			=>	'Selbstabholung',
'SOX_DELIVERY_FREIGHT'			=>	'Fracht',
'SOX_DELIVERY_ADVICE_END'		=>	'entsprechen',
'SOX_DELIVERY_PARCELSERVICE'	=>	'Parcel Services',
'SOX_DELIVERY_DHL'				=>	'DHL',
'SOX_DELIVERY_FEDEX'			=>	'Federal Express',
'SOX_DELIVERY_UPS'				=>	'UPS'

);

?>