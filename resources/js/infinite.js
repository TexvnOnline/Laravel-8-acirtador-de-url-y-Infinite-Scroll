window.infinite = {
    scroll_container: document.getElementById('scroll-container'),
    template: ` 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="__URL__" target="_blanck">http://dffff/__CODE__</a>
                </div>
            </div>
        </div>
        `,
    next_page_url: null,
    has_more: true,
    data: {},

    load_items: (url) => {
        if(infinite.has_more){
            axios.get(url).then((res)=>{
                let response = JSON.parse(res.data.urls);
                
                infinite.next_page_url = response.next_page_url;
    
                infinite.data = response.data;
                infinite.print_items();
                infinite.has_more();
    
            }).catch((error)=>{
                console.log(error);
            });
        }
    },
    print_items: () => {
        infinite.data.forEach((i,j)=>{
            let item_template = infinite.template;
            item_template = item_template.replace('__URL__', i.url);
            item_template = item_template.replace('__CODE__', i.code);
            infinite.scroll_container.innerHTML += item_template;
        });
    },
    has_more: () => {
        if(infinite.next_page_url == null){
            infinite.has_more = false;
        }
    }
}
