/* IMPORTACIONES DE REACT */
import React, { useState } from 'react'

/* IMPORTACION DE LA GRILLA DE LAYOUT PARA LA VISTA */
import GridDashboard from './components/GridDashboard'

const HOST_API = import.meta.env.VITE_API_URL

/* COMPONENTE ROOT QUE DEFINE EL STATE, Y METODOS QUE SE PASARAN A LOS HIJOS POR PROPS */
function Root(props) {
    
    /* CREACIÓN DE UN DICCIONARIO DE ACCESO RAPIDO A LOS INGREDIENTES EN FORMA LLAVE-OBJETO PARA TIEMPOS 0(1) */
    const generateIngredientsDict = (ingredients) => {
        const ingredients_dict = {}
        ingredients.map(ingredient => {  
            ingredients_dict[ingredient.ingredient_key] = ingredient
        }) 
        return ingredients_dict       
    }

    /* HELPER DE ESPERA DE X TIEMPO EN MILISEGUNDOS */
    const delay = ms => new Promise(resolve => setTimeout(resolve, ms))

    /* VARIABLE DE STATE */
    const [state, setState] = useState(() => { 
        /* CREACIÓN DE UN DICCIONARIO DE ACCESO RAPIDO A LOS INGREDIENTES EN FORMA LLAVE-OBJETO PARA TIEMPOS 0(1) */
        const ingredients_dict = generateIngredientsDict(props.ingredients)
        return {...props, ingredients_dict}
    })

    /* FUNCION PARA ACTUALIZAR EL DESPACHO DE UNA ORDEN Y REDUCIR EN 1 LA CANTIDAD DE INGREDIENTES UTILIZADOS */
    const updateOrder = (order) => {  
        /* OBTENER UN ARRAY DE SOLO LAS LLAVES DE LOS INGREDIENTES */
        const orderIngredients = order.food.ingredients.map(obj => obj.ingredient_key)        
        
        /* FETCH AL ENDPOINT DE PUT DE ORDENES */
        fetch(HOST_API+"/orders/"+order.id, 
            {method:"PUT",mode:"same-origin", headers: {"Content-Type": "application/json", "Accept": "application/json"}, 
            body: JSON.stringify({order_delivered:1, ingredients: order.food.ingredients})
        }).then(response => {
            return response.json()
        }).then(data => {
            /* GENERACIÓN DE UNA COPIA DEL ARRAY DE INGREDIENTES CON EL NUMERO DE INGREDIENTES USADOS */
            const ingredients = state.ingredients.map(ingredient => {
                if(orderIngredients.includes(ingredient.ingredient_key))
                    return {...ingredient, ingredient_amount: ingredient.ingredient_amount - 1}     
                return ingredient
            })
            /* CREACIÓN DE UN DICCIONARIO DE ACCESO RAPIDO A LOS INGREDIENTES EN FORMA LLAVE-OBJETO PARA TIEMPOS 0(1) */
            const ingredients_dict = generateIngredientsDict(ingredients)
            /* ACTUALIZACIÓN DEL STATE CON LOS INGREDIENTES USADOS Y EL RETIRO DE LA ORDEN QUE HA SIDO DESPACHADA */        
            setState({...state, orders:state.orders.filter(object => object.id !== data.id), ingredients, ingredients_dict})
            
            /* MOSTRAR UNA TOSTADA INFORMATIVA DEL CUANDOS INGREDIENTES SE USARON */
            showToast(orderIngredients.map(key => "1 "+key+" used \n").join(","),'bg-success', 8000)
        }).catch(() => {
            showToast("Server Error", 'bg-danger')
        })
    }

    /* FUNCION PARA COMPRAR INGREDIENTES A LA BODEGA DE ALEGRA */
    const buyStock = async (ingredients) => {
        /* FUNCION ASYNCRONA PARA HACER UNA PETICIÓN AL ENDPOINT DE ALEGRA */
        async function buyRequest(ingredient){
            let response = await fetch("https://recruitment.alegra.com/api/farmers-market/buy?ingredient="+ingredient)
            .then(response => response.json()).catch(() => ({quantitySold:0}))
            return {...response, success: response.quantitySold > 0}
        }
        /* FUNCION PARA CREAR UNA FACTURA DE COMPRA DE STOCK Y ACTUALIZACIÓN DE CANTIDAD DE INVENTARIO */
        async function updateIngredientAndBuyStock(ingredient, quantitySold, receipt_id){
            return await fetch(HOST_API+"/stocks", {method:"POST",mode:"same-origin", headers: {"Content-Type": "application/json", "Accept": "application/json"}, 
                body: JSON.stringify({ingredient_id:ingredient.id, stock_amount: quantitySold, receipt_id: receipt_id})
            }).then(response => response.json()).then(data => data.id)
        }

        /* INICIALIZACIÓN DE VARIABLES */
        const newStateIngredients = [...state.ingredients]
        let i = 0                
        let receipt_id = null

        /* LOOP QUE RECORRE TODOS LOS INGREDIENTES DE LA ORDEN QUE FUE SELECCIONADA PARA COCINARSE */
        while(i < ingredients.length){   
            /* SI EN LA LISTA DE INGREDIENTES DE LA COMIDA ACTUAL A PREPARAR QUEDAN ALMENOS 1 O MAS INGREDIENTES ENTONCES NO COMPRE Y SALTE DE ITERACIÓN */         
            if(state.ingredients_dict[ingredients[i].ingredient_key].ingredient_amount > 0){
                i = i + 1
                continue;
            }

            /* LLAMAR A LA FUNCION QUE LLAMA AL ENDPOINT DE COMPRA E INICIALIZAR VARIABLES */
            const ingredient = ingredients[i]
            const buy = await buyRequest(ingredient.ingredient_key)            
            /* ESPERAR 750 MILISEGUNDOS */
            await delay(750)            
            /* SI SE COMPRARON MAS DE 0 ENTONCES LA COMPRA FUE EXITOSA Y PROCEDE A ACTUALIZAR EL STATE */
            if(buy.success){
                /* CREACIÓN DE LA FACTURA DE COMPRA Y ACTUALIZACIÓN DE CANTIDAD DE INVENTARIO  */
                receipt_id = await updateIngredientAndBuyStock(ingredient, buy.quantitySold, receipt_id)
                /* ACTUALICE EL INGREDIENTE EXACTO SU CANTIDAD EN EL JSON DE COPIA */
                for(let j = 0; j < newStateIngredients.length; ++j){                    
                    if(newStateIngredients[j].ingredient_key == ingredient.ingredient_key){
                        newStateIngredients[j] = {...newStateIngredients[j], ingredient_amount: newStateIngredients[j].ingredient_amount + buy.quantitySold}
                        break
                    }
                }    
                /* AVANCE A LA SIG ITERACIÓN*/               
                i = i + 1
                /* CREACIÓN DE UN DICCIONARIO DE ACCESO RAPIDO A LOS INGREDIENTES EN FORMA LLAVE-OBJETO PARA TIEMPOS 0(1) */
                const ingredients_dict = generateIngredientsDict(newStateIngredients)  
                /* ACTUALIZACIÓN DEL STATE CON LOS NUEVOS INGREDIENTES COMPRADOS */        
                setState({...state, ingredients: [...newStateIngredients], ingredients_dict})                  
                /* MOSTRAR UNA TOSTADA INFORMATIVA DEL CUANDOS INGREDIENTES SE COMPRARON */
                showToast(buy.quantitySold+" of "+ ingredient.ingredient_key + " Buyed")
            }else /* MOSTRAR UNA TOSTADA DE ERROR PORQUE LA BODEGA ENTREGO 0 PRODUCTOS */
                showToast(buy.quantitySold+" "+ ingredient.ingredient_key + ", Trying again...", 'bg-danger')
        }    
        return true  
    }
    
    return <GridDashboard state={state} updateOrder={updateOrder} buyStock={buyStock}/>
}

export default Root