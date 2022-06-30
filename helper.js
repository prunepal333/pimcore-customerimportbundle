pimcore.registerNS("pimcore.plugin.menusample");
 
pimcore.plugin.menusample = Class.create(pimcore.plugin.admin, {
    getClassName: function () {
        return "pimcore.plugin.menusample";
    },
 
    initialize: function () {
        pimcore.plugin.broker.registerPlugin(this);
 
        this.navEl = Ext.get('pimcore_menu_search').insertSibling('<li id="pimcore_menu_mds" data-menu-tooltip="mds Erweiterungen" class="pimcore_menu_item pimcore_menu_needs_children">mds Erweiterungen</li>', 'after');
        this.menu = new Ext.menu.Menu({
            items: [{
                text: "Item 1",
                iconCls: "pimcore_icon_apply",
                handler: function () {
                    alert("pressed 1");
                }
            }, {
                text: "Item 2",
                iconCls: "pimcore_icon_delete",
                handler: function () {
                    alert("pressed 2");
                }
            }],
            cls: "pimcore_navigation_flyout"
        });
        pimcore.layout.toolbar.prototype.mdsMenu = this.menu;
    },
 
    pimcoreReady: function (params, broker) {
        var toolbar = pimcore.globalmanager.get("layout_toolbar");
        this.navEl.on("mousedown", toolbar.showSubMenu.bind(toolbar.mdsMenu));
        pimcore.plugin.broker.fireEvent("mdsMenuReady", toolbar.mdsMenu);
    }
});
 
var menusamplePlugin = new pimcore.plugin.menusample();