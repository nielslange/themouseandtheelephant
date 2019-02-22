(function() {		
   tinymce.create('tinymce.plugins.ZPShortcodes', {
	  ZPShortcodes: function(editor, url) {
	  	editor.addButton( 'zp_button', {
            title: 'ZP Shortcodes',
            type: 'menubutton',
            icon: 'icon zp_shortcode_icon',
            menu: [
				{ // Accordion Shortcode
					text: zp_shortcode_label.accordion.menu,
                    onclick: function() {
								editor.insertContent( '[accordion_wrap][accordion id="one" title="Title Here" open="true"]CONTENT HERE[/accordion][accordion id="two" title="Title Here" open="false" ]CONTENT HERE[/accordion][accordion id="three" title="Title Here" open="false" ]CONTENT HERE[/accordion][/accordion_wrap]');
                    }	
				},
				{ // Blog
					text: zp_shortcode_label.blog.menu,
                    onclick: function() {
      					editor.insertContent( '[zp_blog items="-1" columns="3" filter="true" category="" load_more="true" ]' );
                    }	
				},
				{ // Buttons
					text: zp_shortcode_label.buttons.menu,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: zp_shortcode_label.buttons.header_title,
							minWidth: 500,
							popup_css: false,
							scrollbars: true,
                            body: [
							{
								type: 'listbox',
								minWidth: 310,
                                name: 'type',
                                label: zp_shortcode_label.buttons.content.type.label,
								tooltip: zp_shortcode_label.buttons.content.type.tooltip,
								'values': [
                                    {text: zp_shortcode_label.buttons.content.type.values[0], value: 'btn-default'},
                                    {text: zp_shortcode_label.buttons.content.type.values[1], value: 'btn-primary'},
									{text: zp_shortcode_label.buttons.content.type.values[2], value: 'btn-success'},
									{text: zp_shortcode_label.buttons.content.type.values[3], value: 'btn-info'},
									{text: zp_shortcode_label.buttons.content.type.values[4], value: 'btn-warning'},
									{text: zp_shortcode_label.buttons.content.type.values[5], value: 'btn-danger'},
									{text: zp_shortcode_label.buttons.content.type.values[6], value: 'btn-inverse'}
                                ]					
							},
							{
								type: 'listbox',
								minWidth: 310,
                                name: 'size',
                                label: zp_shortcode_label.buttons.content.size.label,
								tooltip: zp_shortcode_label.buttons.content.size.tooltip,
								'values': [
                                    {text: zp_shortcode_label.buttons.content.size.values[0], value: 'btn-lg'},
									{text: zp_shortcode_label.buttons.content.size.values[1], value: ''},
									{text: zp_shortcode_label.buttons.content.size.values[2], value: 'btn-sm'},
									{text: zp_shortcode_label.buttons.content.size.values[3], value: 'btn-xs'}
                                ]					
							},
							{
								type: 'listbox',
								minWidth: 310,
                                name: 'outline',
                                label: zp_shortcode_label.buttons.content.outline.label,
								tooltip: zp_shortcode_label.buttons.content.outline.tooltip,
								'values': [
                                    {text: zp_shortcode_label.buttons.content.outline.values[0], value: 'true'},
                                    {text: zp_shortcode_label.buttons.content.outline.values[1], value: 'false'}
                                ]					
							},
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'button_link',
                                label: zp_shortcode_label.buttons.content.button_link.label,
								tooltip: zp_shortcode_label.buttons.content.button_link.tooltip,						
							},
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'button_label',
                                label: zp_shortcode_label.buttons.content.button_label.label,
								tooltip: zp_shortcode_label.buttons.content.button_label.tooltip,						
							},
							{
								type: 'listbox',
								minWidth: 310,
                                name: 'button_target',
                                label: zp_shortcode_label.buttons.content.button_target.label,
								tooltip: zp_shortcode_label.buttons.content.button_target.tooltip,
								'values': [
                                    {text: zp_shortcode_label.buttons.content.button_target.values[0], value: '_blank'},
                                    {text: zp_shortcode_label.buttons.content.button_target.values[1], value: '_self'},
									{text: zp_shortcode_label.buttons.content.button_target.values[2], value: '_top'},
									{text: zp_shortcode_label.buttons.content.button_target.values[3], value: '_parent'}
                                ]						
							}
							],
                            onsubmit: function( e ) {
								editor.insertContent( '[zp_button type="'+e.data.type+'" size="'+e.data.size+'" outline="'+e.data.outline+'" link="'+e.data.button_link+'" target="'+e.data.button_target+'"]'+e.data.button_label+'[/zp_button]');
                            }
                        });
                    }	
				},
				{ // Columns
					text: zp_shortcode_label.columns.menu,
                    menu: [
                        {
                            text: zp_shortcode_label.columns.submenu.one_half,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[one_half]CONTENT_HERE[/one_half]<br>[one_half]CONTENT_HERE[/one_half]<br>[/column_wrapper]');
							}       
                        },
                        {
                            text: zp_shortcode_label.columns.submenu.one_third,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[one_third]CONTENT_HERE[/one_third]<br>[one_third]CONTENT_HERE[/one_third]<br>[one_third]CONTENT_HERE[/one_third]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.one_fourth,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[one_fourth]CONTENT_HERE[/one_fourth]<br>[one_fourth]CONTENT_HERE[/one_fourth]<br>[one_fourth]CONTENT_HERE[/one_fourth]<br>[one_fourth]CONTENT_HERE[/one_fourth]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_1,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_1]CONTENT_HERE[/column_grid_1]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_2,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_2]CONTENT_HERE[/column_grid_2]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_3,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_3]CONTENT_HERE[/column_grid_3]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_4,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_4]CONTENT_HERE[/column_grid_4]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_5,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_5]CONTENT_HERE[/column_grid_5]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_6,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_6]CONTENT_HERE[/column_grid_6]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_7,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_7]CONTENT_HERE[/column_grid_7]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_8,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_8]CONTENT_HERE[/column_grid_8]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_9,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_9]CONTENT_HERE[/column_grid_9]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_10,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_10]CONTENT_HERE[/column_grid_10]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_11,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_11]CONTENT_HERE[/column_grid_11]<br>[/column_wrapper]');
							}       
                        },
						{
                            text: zp_shortcode_label.columns.submenu.column_grid_12,
                            onclick: function() {
								editor.insertContent( '[column_wrapper]<br>[column_grid_12]CONTENT_HERE[/column_grid_12]<br>[/column_wrapper]');
							}       
                        },
                    ]
				},
				{ // Portfolio
					text: zp_shortcode_label.portfolio.menu,
                    onclick: function() {
      					editor.insertContent( '[zp_portfolio items="-1" columns="3" category="" filter="" load_more="true" ]');
                    }	
				},
				{ // Progress Bar
					text: zp_shortcode_label.progress.menu,
                    onclick: function() {
      					editor.insertContent( '[zp_progress label="" value="" type="" stripe="" ]');
                    }	
				},
				{ // Service
					text: zp_shortcode_label.services.menu,
                    onclick: function() {
                        editor.insertContent( '[services class=""]<br>[service_item column="3" title="" align="" icon="" btn_target="" btn_link="" btn_name="" ] CONTENT HERE [/service_item]<br>[service_item column="3" title="" align="" icon="" btn_target="" btn_link="" btn_name="" ] CONTENT HERE [/service_item]<br>[service_item column="3" title="" align="" icon="" btn_target="" btn_link="" btn_name="" ] CONTENT HERE [/service_item]<br>[/services]');
                    }	
				},
				{ // Slider
					text: zp_shortcode_label.slider.menu,
                    onclick: function() {
                        editor.insertContent( '[zp_slider id="" navigation="true" indicator="true" items="3" ][slide_item image="" title="" link="" active="true"][/slide_item][/zp_slider]');
                    }	
				},
				{
				// Tab Shortcode
					text: zp_shortcode_label.tab.menu,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: zp_shortcode_label.tab.header_title,
							minWidth: 500,
							height: 400,
							popup_css: false,
							scrollbars: true,
                            body: [
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'id1',
                                label: zp_shortcode_label.tab.content.id1.label,
								tooltip: zp_shortcode_label.tab.content.id1.tooltip,						
							},
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'title1',
                                label: zp_shortcode_label.tab.content.title1.label,
								tooltip: zp_shortcode_label.tab.content.title1.tooltip,						
							},
							{
								type: 'textbox',
								multiline: true,
								minHeight: 100,
								minWidth: 310,
                                name: 'content1',
                                label: zp_shortcode_label.tab.content.content1.label,
								tooltip: zp_shortcode_label.tab.content.content1.tooltip,						
							},
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'id2',
                                label: zp_shortcode_label.tab.content.id2.label,
								tooltip: zp_shortcode_label.tab.content.id2.tooltip,						
							},
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'title2',
                                label: zp_shortcode_label.tab.content.title2.label,
								tooltip: zp_shortcode_label.tab.content.title2.tooltip,						
							},
							{
								type: 'textbox',
								multiline: true,
								minHeight: 100,
								minWidth: 310,
                                name: 'content2',
                                label: zp_shortcode_label.tab.content.content2.label,
								tooltip: zp_shortcode_label.tab.content.content2.tooltip,						
							},
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'id3',
                                label: zp_shortcode_label.tab.content.id3.label,
								tooltip: zp_shortcode_label.tab.content.id3.tooltip,						
							},
							{
								type: 'textbox',
								minWidth: 310,
                                name: 'title3',
                                label: zp_shortcode_label.tab.content.title3.label,
								tooltip: zp_shortcode_label.tab.content.title3.tooltip,						
							},
							{
								type: 'textbox',
								multiline: true,
								minHeight: 100,
								minWidth: 310,
                                name: 'content3',
                                label: zp_shortcode_label.tab.content.content3.label,
								tooltip: zp_shortcode_label.tab.content.content3.tooltip,						
							},
							],
                            onsubmit: function( e ) {
								editor.insertContent( '[tab ids="'+e.data.id1+','+e.data.id2+','+e.data.id3+'" nav="'+e.data.title1+','+e.data.title2+','+e.data.title3+'"]<br>[tabpane id="'+e.data.id1+'"]'+e.data.content1+'[/tabpane]<br>[tabpane id="'+e.data.id2+'"]'+e.data.content2+'[/tabpane]<br>[tabpane id="'+e.data.id3+'"]'+e.data.content3+'[/tabpane]<br>[/tab]');
                            }
                        });
                    }	
				},
				{ // Team
					text: zp_shortcode_label.team.menu,
                    onclick: function() {
						editor.insertContent( '[team][team_item column="3" align="center" title="John Doe" position="Developer" image_url="" image_style=""  github="#" linkedin="#" youtube="#"]CONTENT HERE[/team_item][/team]');
                    }	
				},
				{ // Testimonial Shortcode
					text: zp_shortcode_label.testimonial.menu,
                    onclick: function() {
						editor.insertContent( '[testimonial id="" ]<br>[testimonial_item active="true" title="" image_url="" ]CONTENT HERE[/testimonial_item]<br>[testimonial_item title="" image_url="" ]CONTENT HERE[/testimonial_item]<br>[testimonial_item title="" image_url="" ]CONTENT HERE[/testimonial_item]<br>[/testimonial]');
                    }	
				}				
           ]
        });
	  }
});

// Register plugin using the add method
tinymce.PluginManager.add('zp_button', tinymce.plugins.ZPShortcodes);
})();