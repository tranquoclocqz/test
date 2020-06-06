/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
var d = new Date();
var n = d.getTime();
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.allowedContent = true;
	config.fontSize_sizes = '8/8px; 9/9px; 10/10px; 11/11px; 12/12px; 13/13px; 14/14px; 15/15px; 16/16px; 17/17px; 18/18px; 19/19px; 20/20px; 21/21px; 22/22px; 23/23px; 24/24px; 25/25px; 26/26px; 27/27px; 28/28px; 29/29px; 30/30px; 31/31px; 32/32px; 33/33px; 34/34px; 35/35px; 36/36px; 37/37px; 38/38px; 39/39px; 40/40px; 41/41px; 42/42px; 43/43px; 44/44px; 45/45px; 46/46px; 47/47px; 48/48px; 49/49px; 50/50px; 51/51px; 52/52px; 53/53px; 54/54px; 55/55px; 56/56px; 57/57px; 58/58px; 59/59px; 60/60px; 61/61px; 62/62px; 63/63px; 64/64px; 65/65px; 66/66px; 67/67px; 68/68px; 69/69px; 70/70px; 71/71px; 72/72px; 73/73px; 74/74px; 75/75px; 76/76px; 77/77px; 78/78px; 79/79px; 80/80px; 81/81px; 82/82px; 83/83px; 84/84px; 85/85px; 86/86px; 87/87px; 88/88px; 89/89px; 90/90px; 91/91px; 92/92px; 93/93px; 94/94px; 95/95px; 96/96px; 97/97px; 98/98px; 99/99px; 100/100px; 101/101px; 102/102px; 103/103px; 104/104px; 105/105px; 106/106px; 107/107px; 108/108px; 109/109px; 110/110px; 111/111px; 112/112px; 113/113px; 114/114px; 115/115px; 116/116px; 117/117px; 118/118px; 119/119px; 120/120px; 121/121px; 122/122px; 123/123px; 124/124px; 125/125px; 126/126px; 127/127px; 128/128px;';
	config.defaultLanguage = 'vi';
	config.extraPlugins = 'iframedialog,image2,imageresponsive,widget,lineutils,dialog,clipboard,lineheight,youtube,texttransform,ckawesome';
	config.line_height="12px;13px;14px;15px;16px;17px;18px;19px;20px;21px;22px;23px;24px;25px;26px;27px;28px;29px;30px;31px;32px;33px;34px;35px;36px;37px;38px;39px;40px;41px;42px;43px;44px;45px;46px;47px;48px;49px;50px;51px;52px;53px;54px;55px;56px;57px;58px;59px;60px;61px;62px;63px;64px;65px;66px;67px;68px;69px;70px;71px;72px;73px;74px;75px;76px;77px;78px;" ;
	config.toolbar = 'Full';
	config.contentsCss = 'ckeditor/fonts/fonts.css?v=' + n;
	config.fontawesomePath = 'ckeditor/font-awesome/css/font-awesome.min.css';
	config.font_names = "Roboto/Roboto;Tahoma/Tahoma;Arial/Arial;Times New Roman/Times New Roman;Verdana/Verdana;Helvetica/Helvetica;";
};