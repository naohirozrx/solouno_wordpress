import{o as m,c as b,x as o,l as _,m as r,a,D as p,t as c,C as i,d as L}from"./vue.esm-bundler.CWQFYt9y.js";import{_ as g}from"./_plugin-vue_export-helper.BN1snXvA.js";import{f as B}from"./links.BdfvOpfI.js";import{_ as t,s as M}from"./default-i18n.Bd0Z306Z.js";import{C as w}from"./Blur.DNVDismY.js";import{C as I}from"./SettingsRow.DQldd-1Z.js";import{S as V}from"./External.Bfg4674G.js";import{B as A}from"./RadioToggle.BLVmJ7Zx.js";import{R as G}from"./RequiredPlans.DD8UwVw8.js";import{C as R}from"./Card.CacAhFkZ.js";import{C as N}from"./ProBadge.WwPkDor4.js";import{C as D}from"./Index.XNbBlAFo.js";import{A as P}from"./AddonConditions.CXG7tzuk.js";import"./helpers.pkmhnyB1.js";import"./Row.CzuhYwfs.js";import"./addons.C79zowsK.js";import"./upperFirst.Wa3gt1AT.js";import"./_stringToArray.DnK4tKcY.js";import"./toString.C-weURPh.js";import"./license.D7gbNQw6.js";import"./Caret.iRBf3wcH.js";import"./Tooltip.Jp05nfCy.js";import"./index.BQgiQQKQ.js";import"./Slide.CRIn0kdn.js";import"./constants.DpuIWwJ9.js";const s="all-in-one-seo-pack",T=()=>({strings:{customFieldSupport:t("Custom Field Support",s),exclude:t("Exclude Pages/Posts",s),video:t("Video Sitemap",s),description:t("The Video Sitemap generates an XML Sitemap for video content on your site. Search engines use this information to display rich snippet information in search results.",s),extendedDescription:t("The Video Sitemap works in much the same way as the XML Sitemap module, it generates an XML Sitemap specifically for video content on your site. Search engines use this information to display rich snippet information in search results.",s),enableSitemap:t("Enable Sitemap",s),openSitemap:t("Open Video Sitemap",s),noIndexDisplayed:t("Noindexed content will not be displayed in your sitemap.",s),doYou404:t("Do you get a blank sitemap or 404 error?",s),ctaButtonText:t("Unlock Video Sitemaps",s),ctaHeader:M(t("Video Sitemaps is a %1$s Feature",s),"PRO"),linksPerSitemap:t("Links Per Sitemap",s),maxLinks:t("Allows you to specify the maximum number of posts in a sitemap (up to 50,000).",s),enableSitemapIndexes:t("Enable Sitemap Indexes",s)}}),H={};function O(e,S){return m(),b("div")}const U=g(H,[["render",O]]),E={setup(){const{strings:e}=T();return{strings:e}},components:{CoreBlur:w,CoreSettingsRow:I,SvgExternal:V,BaseRadioToggle:A}},F={class:"aioseo-settings-row aioseo-section-description"},q=["innerHTML"],X={class:"aioseo-sitemap-preview"},z={class:"aioseo-description"},Y=a("br",null,null,-1),j=["innerHTML"],J={class:"aioseo-description"},K=["innerHTML"],Q={class:"aioseo-description"},W=["innerHTML"];function Z(e,S,k,n,v,y){const d=o("base-toggle"),l=o("core-settings-row"),u=o("svg-external"),f=o("base-button"),h=o("base-radio-toggle"),$=o("base-input"),C=o("core-blur");return m(),_(C,null,{default:r(()=>[a("div",F,[p(c(n.strings.extendedDescription)+" ",1),a("span",{innerHTML:e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"videoSitemaps",!0)},null,8,q)]),i(l,{name:n.strings.enableSitemap},{content:r(()=>[i(d,{modelValue:!0})]),_:1},8,["name"]),i(l,{name:e.$constants.GLOBAL_STRINGS.preview},{content:r(()=>[a("div",X,[i(f,{size:"medium",type:"blue"},{default:r(()=>[i(u),p(" "+c(n.strings.openSitemap),1)]),_:1})]),a("div",z,[p(c(n.strings.noIndexDisplayed)+" ",1),Y,p(" "+c(n.strings.doYou404)+" ",1),a("span",{innerHTML:e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"blankSitemap",!0)},null,8,j)])]),_:1},8,["name"]),i(l,{name:n.strings.enableSitemapIndexes},{content:r(()=>[i(h,{name:"sitemapIndexes",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},null,8,["options"]),a("div",J,[p(c(n.strings.sitemapIndexes)+" ",1),a("span",{innerHTML:e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"sitemapIndexes",!0)},null,8,K)])]),_:1},8,["name"]),i(l,{name:n.strings.linksPerSitemap},{content:r(()=>[i($,{class:"aioseo-links-per-site",type:"number",size:"medium",min:1,max:5e4}),a("div",Q,[p(c(n.strings.maxLinks)+" ",1),a("span",{innerHTML:e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"maxLinks",!0)},null,8,W)])]),_:1},8,["name"])]),_:1})}const ee=g(E,[["render",Z]]),ne={setup(){const{strings:e}=T();return{licenseStore:B(),strings:e}},components:{Blur:ee,RequiredPlans:G,CoreCard:R,CoreProBadge:N,Cta:D}},oe={class:"aioseo-video-sitemap-lite"};function te(e,S,k,n,v,y){const d=o("core-pro-badge"),l=o("blur"),u=o("required-plans"),f=o("cta"),h=o("core-card");return m(),b("div",oe,[i(h,{slug:"videoSitemap",noSlide:!0},{header:r(()=>[a("span",null,c(n.strings.video),1),i(d)]),default:r(()=>[i(l),i(f,{"feature-list":[n.strings.customFieldSupport,n.strings.exclude],"cta-link":e.$links.getPricingUrl("video-sitemap","video-sitemap-upsell"),"button-text":n.strings.ctaButtonText,"learn-more-link":e.$links.getUpsellUrl("video-sitemap",null,e.$isPro?"pricing":"liteUpgrade"),"hide-bonus":!n.licenseStore.isUnlicensed},{"header-text":r(()=>[p(c(n.strings.ctaHeader),1)]),description:r(()=>[i(u,{addon:"aioseo-video-sitemap"}),p(" "+c(n.strings.description),1)]),_:1},8,["feature-list","cta-link","button-text","learn-more-link","hide-bonus"])]),_:1})])}const x=g(ne,[["render",te]]),se={mixins:[P],components:{Cta:U,Lite:x,VideoSitemap:x},data(){return{addonSlug:"aioseo-video-sitemap"}}},ie={class:"aioseo-video-sitemap"};function ae(e,S,k,n,v,y){const d=o("video-sitemap",!0),l=o("cta"),u=o("lite");return m(),b("div",ie,[e.shouldShowMain?(m(),_(d,{key:0})):L("",!0),e.shouldShowUpdate||e.shouldShowActivate?(m(),_(l,{key:1})):L("",!0),e.shouldShowLite?(m(),_(u,{key:2})):L("",!0)])}const Ve=g(se,[["render",ae]]);export{Ve as default};
