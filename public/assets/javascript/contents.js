(function(){

    new Vue({
        el: '#js-contents',
        data: {
            headings: []
        },
        mounted: function(){

            var contentTarget = document.getElementById('js-contents-target'),
                h2s = contentTarget.querySelectorAll('h2');

            for(var i = 0; i < h2s.length; i++){  
                
                var str = h2s[i].innerHTML,
                    slug = this.slugify(str);

                    h2s[i].id = slug;
                    h2s[i].className = "anchor";
                    
                    if (i > 0) {
                        contentTarget.insertBefore(this.up(), h2s[i]);
                    }
                
                this.headings.push({
                    label: str,
                    name: slug
                });
            }

            contentTarget.appendChild(this.up());

        },
        methods:{
            slugify: function(str){
                str = str.replace(/^\s+|\s+$/g, ''); // trim
                str = str.toLowerCase();
              
                // remove accents, swap ñ for n, etc
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to   = "aaaaeeeeiiiioooouuuunc------";
                for (var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }
            
                str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes
            
                return str;
            },
            up: function(){
                var link = document.createElement("a");                                        
                    link.href = "#js-contents";                                            
                    link.appendChild(document.createTextNode("^^"));  

                var p = document.createElement("p");   
                    p.className = "u-pull-right";    
                    p.appendChild(link);               

                return p;
            }
        }
    })

})();
    

