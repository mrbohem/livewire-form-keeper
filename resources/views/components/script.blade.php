<script>
    const WireState = function(){
        let data = {};
    
        WireState.prototype.set = function(componentName,componentData){
            for(let key in componentData){
                if (!data.hasOwnProperty(componentName)) {
                    data[componentName] = {};
                }
                if(typeof componentData[key] == "object"){
                    if(componentData[key][1]['s'] == "form"){
                        data[componentName][key] = componentData[key][0]
                    }
                }
                else{
                    data[componentName] = componentData;
                }
            }
        }
    
        WireState.prototype.setComponentModel = function(componentName,model,value){
            if(model.includes('.')){
               [table,field] = model.split('.');
               data[componentName][table][field] = value;
            }
            else{
                data[componentName][model] = value;
            }
        }
    
        WireState.prototype.get = function(componentName){
            return data[componentName];
        }
    
        WireState.prototype.getData = function(){
            return data;
        }
    
        WireState.prototype.isComponentRegistered = function(componentName){
            return componentName in data;
        }
    
        
    };
    
    let state = new WireState();
    
    // set into state object
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.all().forEach(component => {
            state.set(component.name,component.snapshot.data);
        });
    });
    
    document.addEventListener('input',(event)=>{
        el = event.target
        model = el.getAttribute("wire:model")
        closestRoot = Alpine.closestRoot(el);
        component = closestRoot.__livewire;
        state.setComponentModel(component.name,model,event.target.value);
    });
    
    document.addEventListener('livewire:navigated', () => {
        Livewire.hook('component.init', ({component}) => {
            if(state.isComponentRegistered(component.name))
            {
                data = state.get(component.name);
                for (const key in data) {
                    if (Object.hasOwnProperty.call(data, key)) {
                        component.$wire.set(key,data[key],false);
                    }
                }
                component.$wire.refreshComp();
            }
            else{
                state.set(component.name,component.snapshot.data);
            }
        })
    })
    
    Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
        respond(() => {
        })
     
        succeed(({ snapshot, effect }) => {
            snapshot = JSON.parse(snapshot);
            state.set(snapshot.memo.name,snapshot.data);
        })
     
        fail(() => {
        })
    })
    </script>