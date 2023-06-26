/* IMPORTACIONES DE REACT */
import React, { useEffect, useState } from 'react'

/* COMPONENTE DE PANEL DE HUD INFORMATIVO DE LA APLICACIÓN */
function HudComponent({ current, setCurrent, ingredients, updateOrder, buyStock }) {
    
    /* VARIABLE DE ESTADO */
    const [state, setState] = useState(0)

    /* EFECTO QUE ACTUALIZA EL ESTADO SI SE SELECCIONO UNA ORDEN PARA CAMBIAR ENTRE PANEL DE UI INFORMATIVO */
    useEffect(() => {
        if(!current)
            setState(0)            
        else
            setState(1)
    }, [current])

    /* FUNCION PARA DESSELECCIONAR EL ELEMENTO SELECCIONADO */
    const closeCurrent = () => {
        setCurrent(null)
        setState(0)
    }

    /* SEGUN EL ESTADO MUESTRE DIFERENTES COMPONENTES */
    switch(state){
        case 0: return <HUDWaiting/>
        case 1: return <HUDStart current={current} closeCurrent={closeCurrent} setState={setState} ingredients={ingredients}/>
        case 2: return <HUDBuying current={current} buyStock={buyStock} setState={setState}/>
        case 3: return <HUDCooking current={current} closeCurrent={closeCurrent} updateOrder={updateOrder}/>
        default: return <HUDWaiting/>
    }
}

/* COMPONENTE QUE MUESTRA UN PANEL DE ESPERA DE ACCIONES, ES EL INICIAL POR DEFECTO */
function HUDWaiting(){
    return (        
            <div className='hud-waiting'>
                <div>
                    <div className="loading-circles">
                        <span>
                            <div className="circle"></div>
                            <div className="circle circle-anim"></div>
                            <div className="circle circle-anim-2"></div>
                        </span>
                    </div>
                    <h2>Waiting Instructions</h2>
                </div>
            </div>        
    )
}
/* PANEL DE UI QUE MUESTRA LA ORDEN ACTUAL SELECCIONADA Y UNA OPCION PARA COMENZAR A DESPACHARLA */
const HUDStart = React.memo(({current, setState, ingredients, closeCurrent}) => {  
    
    /* FUNCION PARA COMENZAR EL COCINADO SI DISPONE DE INGREDIENTES, SINO ENTONCES VAYA AL HUD DE COMPRA */
    const startCooking = () => {                
        const hasIngredients = current.food.ingredients.reduce((prev, currVal) => prev && (ingredients[currVal.ingredient_key].ingredient_amount > 0), true)
        
        /* SI TIENE INGREDIENTES VAYA AL HUD DE COCINA, SINO ENTONCES AL DE COMPRA DE STOCK */
        if(hasIngredients)
            setState(3)
        else
            setState(2)
    }
    
    return (
        <div className='hud-start'>
            <div className='text-center'>
                <h2>Order {current.id}</h2>
                <p className='text-center mb-3'>{current.food.food_name}</p>
                <button className='hud-start-btn-start mb-3 mx-auto' onClick={startCooking}>Dispatch</button>
                <button className='hud-start-btn-cancel mx-auto' onClick={closeCurrent}>Cancel</button>
            </div>
        </div>
    )
})

const HUDBuying = React.memo(({current, buyStock, setState}) => {    
    /* EFECTO QUE AL MONTAR EL COMPONENTE COMPRA STOCK CON LOS INGREDIENTES DE LA ORDEN SELECCIONADA Y AVANZA SI ES EXITOSO */
    useEffect(() => {
        buyStock(current.food.ingredients).then(() => {setState(3)})
    }, [])

    return (
        <div className='hud-buying'>
            <div className='text-center'>
                <div className="spinner-border text-dark" role="status">
                    <span className="visually-hidden">Loading...</span>
                </div>
                <h3>Buying</h3>
            </div>
        </div>
    )
})

/* COMPONENTE DE COCINADO Y DESPACHO DE ORDENES */
const HUDCooking = React.memo(({current, updateOrder, closeCurrent}) => {
    
    /* EFECTO QUE ACTUALIZARA EL DESPACHO DE LA ORDEN SELECCIONADA Y REDUCIR EN 1 LA CANTIDAD DE INGREDIENTES UTILIZADOS */
    useEffect(() => {        
        setTimeout(() => {
            updateOrder(current)
            setTimeout(() => {closeCurrent()}, 300)
        }, 2000)
    }, [])

    return (
        <div className='hud-cooking'>
            <div className='text-center'>
                <div className="spinner-grow text-warning" role="status">
                    <span className="visually-hidden">Loading...</span>
                </div>

                <h3>Baking</h3>
            </div>
        </div>
    )
})

export default React.memo(HudComponent)