import os
import mysql.connector

# Connexion à la base de données MySQL
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="cesi_ton_job"
)
cursor = conn.cursor()

cursor.execute("SET FOREIGN_KEY_CHECKS = 0")

# Chemin vers le fichier create.sql
reset = "database/create.sql"

with open(reset, "r") as reset_file:
    script = reset_file.read()
    try:
        cursor.execute(script, multi=True)
        conn.commit()
        print(f"Script {reset} exécuté avec succès.")
    except mysql.connector.Error as err:
        print(f"Erreur lors de l'exécution du script {reset}: {err}")

# Chemin vers le dossier contenant les scripts SQL
dossier_scripts = "database/fills"

# Parcours de tous les fichiers dans le dossier
for fichier in os.listdir(dossier_scripts):
    if fichier.endswith(".sql"):
        chemin_fichier = os.path.join(dossier_scripts, fichier)
        with open(chemin_fichier, "r") as script_file:
            script = script_file.read()
            try:
                cursor.execute(script)
                conn.commit()
                print(f"Script {fichier} exécuté avec succès.")
            except mysql.connector.Error as err:
                print(f"Erreur lors de l'exécution du script {fichier}: {err}")

# Fermeture de la connexion
cursor.close()
conn.close()
