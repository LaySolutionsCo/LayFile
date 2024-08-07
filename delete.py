import os
import time

while True:
    dossier1 = "D:\\file_upload_lf\\" 

    for fichier in os.listdir(dossier1):
        chemin_fichier = os.path.join(dossier1, fichier)

        if os.path.isfile(chemin_fichier):
            if fichier.endswith("&&&&no"):
                date_modification = os.path.getmtime(chemin_fichier)

                if date_modification <= time.time() - 7 * 24 * 60 * 60:
                    try:
                        os.remove(chemin_fichier)
                        print(f"Fichier supprimé : {chemin_fichier}")
                    except OSError as e:
                        print(f"Échec de la suppression du fichier : {chemin_fichier}, Erreur : {e}")

    print("Attente de 2 minutes avant la prochaine itération...")
    time.sleep(2 * 60)  
