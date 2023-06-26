import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'

import os from 'os';

const getIPAddress = () => {
  const interfaces = os.networkInterfaces();
  for (const interfaceName in interfaces) {
    const ifaceList = interfaces[interfaceName];
    const iface = ifaceList.find(({ family, internal }) => family === 'IPv4' && !internal);
    if (iface) {
      return iface.address;
    }
  }
  return 'localhost';
};

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        })
    ],
    server: {
       port: 3000,    
       hmr: {
          host: getIPAddress()
       }     
    }    
});
