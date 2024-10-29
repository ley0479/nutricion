import google.generativeai as genai
import sys

# Configura tu API Key
api_key = "AIzaSyCJ0xT_Jqsb82qhK0u62TeNCldOHFTX2o8"
genai.configure(api_key=api_key)
model = genai.GenerativeModel("gemini-1.5-flash")

def obtener_recomendaciones(prompt):
    try:
        response = model.generate_content(prompt)
        return response.text
    except Exception as e:
        return f"Error al generar recomendaciones: {str(e)}"

if __name__ == "__main__":
    # Obtener el prompt de los argumentos
    if len(sys.argv) < 2:
        print("No se proporcionó un prompt.")
        sys.exit(1)

    prompt = sys.argv[1]
    recomendaciones = obtener_recomendaciones(prompt)

    # Asegúrate de que la salida sea en UTF-8
    sys.stdout.buffer.write(recomendaciones.encode('utf-8'))
