/* IMPORTACIONES DE REACT */
import { createRoot } from 'react-dom/client'
import Root from './Root'

/* CREACIÓN DEL ROOT PARA EL ENTORNO DE REACT */
if(document.getElementById('root')){
    /* PROPS PASADOS DE LARAVEL A REACT */
    const props = Object.assign({}, document.getElementById('props').dataset)
    Object.keys(props).map(key => { props[key] = JSON.parse(props[key]) })
    
    /* CREACIÓN DEL ROOT */
    createRoot(document.getElementById('root')).render(<Root {...props}/>)
}