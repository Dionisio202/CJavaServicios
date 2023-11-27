public DefaultTableModel  obtener(javax.swing.JTable Tabla){
        DefaultTableModel modelo;
          modelo= (DefaultTableModel) Tabla.getModel();
           modelo.setRowCount(0);
        try{
        HttpClient cliente = HttpClientBuilder.create().build();
        HttpGet get = new HttpGet("http://localhost/Quinto/api.php");
        HttpResponse respuesta=cliente.execute(get);
        String info=EntityUtils.toString(respuesta.getEntity());
        JSONArray jsonArray = new JSONArray(info);
            for (int i = 0; i < jsonArray.length(); i++)
             {
                JSONObject jsonObject = jsonArray.getJSONObject(i);
                String cedula = jsonObject.getString("cedula");
                String nombre = jsonObject.getString("nombre");
                String apellido = jsonObject.getString("apellido");
                String direccion = jsonObject.getString("direccion");
                String telefono = jsonObject.getString("telefono");
                modelo.addRow(new Object[]{cedula,nombre,apellido,direccion,telefono});
            }
            return modelo;
        }catch(Exception e){
            System.out.println(e);
            return null;
        }
     
    }
     public void insertar(String cedula , String nombre , String apellido , String telefono , String direccion) {
        try{
            String url = "http://localhost/Quinto/api.php";
            HttpClient cliente = HttpClientBuilder.create().build();
            HttpPost post = new HttpPost(url);
            ArrayList<BasicNameValuePair> parametros = new ArrayList<BasicNameValuePair>();
            parametros.add(new BasicNameValuePair("cedula",cedula));
            parametros.add(new BasicNameValuePair("nombre",nombre));
            parametros.add(new BasicNameValuePair("apellido",apellido));
            parametros.add(new BasicNameValuePair("direccion",direccion));
            parametros.add(new BasicNameValuePair("telefono",telefono));
            post.setEntity(new UrlEncodedFormEntity(parametros));
            cliente.execute(post);
        }catch(Exception e){
            System.out.println("Error  : "+e);
        }
        
    }
     
     

    public void editar(String cedula , String nombre , String apellido , String telefono , String direccion) {
        try{
        String apiUrl="http://localhost/Quinto/api.php"; 
        String urlParametros="cedula="+cedula+"&nombre="+nombre+"&apellido="+apellido+"&direccion="+direccion+"&telefono="+telefono;
        
        URL url = new URL(apiUrl+"?"+urlParametros);
        HttpURLConnection connection =(HttpURLConnection) url.openConnection();
           connection.setRequestMethod("PUT");
          int respuesta= connection.getResponseCode();
            System.out.println(respuesta);
        }catch(Exception e){
            System.out.println(e);
        }
    }
    
   
       public void eliminar(String cedula) {
        try{
        String apiUrl="http://localhost/Quinto/api.php";
        String urlParametros="cedula="+cedula;
        
        URL url = new URL(apiUrl+"?"+urlParametros);
        HttpURLConnection connection =
                    (HttpURLConnection) url.openConnection();
            connection.setRequestMethod("DELETE");
           connection.getResponseCode();
   
        
        
        }catch(Exception e){
            System.out.println(e);
        }
    }