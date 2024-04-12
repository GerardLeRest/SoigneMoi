# source - tableau:
# https://stackoverflow.com/questions/75294027/why-is-my-tkinter-treeview-not-changing-colors

import requests
import tkinter as tk
from tkinter import ttk
from tkinter.messagebox import showinfo

class Tableau_patients(tk.Toplevel):
    
    def __init__(self, fenetre, url):
        tk.Toplevel.__init__(self, fenetre) # Initialisation de la fenêtre Toplevel avec 'fenetre' comme parent.
        self.title = ("Personnes")
        self.geometry("700x400")  # Dimensions de la fenêtrefenetre_application("Fenêtre Secondaire")
        self.url = url
        self.liste_personnes = {}
        ## Tableau Triview
        # définir les colonnes du tableau
        columns = ('first_name', 'surname', 'age')
        self.tree = ttk.Treeview(self, columns=columns, show='headings')
        self.tree.grid(row=0, column=0, sticky='nsew')
        self.recuperation_donnees()
        self.affichage_tableau()
        self.habillage_tableau()
        # sélection d'un enregistrement
        self.tree.bind('<<TreeviewSelect>>', self.item_selected)
        self.numero_ligne=0
        
    def recuperation_donnees(self):

        # L'URL du serveur d'où récupérer les données JSON
        #self.url = 'http://127.0.0.1:5000/personnes'

        # Envoyer la requête GET
        reponse = requests.get(self.url)

        # Vérifier si la requête a réussi
        if reponse.status_code == 200:
            # Transformer le format json en listes
            self.liste_personnes = reponse.json()
            print(self.liste_personnes)
        else:
            print(f"Erreur lors de la récupération des données: {reponse.status_code}")
    
    def affichage_tableau(self):
            
        # style the widget
        s = ttk.Style()
        s.theme_use('clam')
        
        # define headings
        self.tree.heading('first_name', text='First_name')
        self.tree.heading('surname', text='Surname')
        self.tree.heading('age', text='Age')
        s.configure('Treeview.Heading', background="lightblue")

        # generate sample data
        contacts = []
        for personne in self.liste_personnes: # c'est une liste de dictionnaire!
            contacts.append(f"{personne['first_name']}, {personne['surname']}, {personne['age']}")
        # add data to the treeview AND tag the row color
        i = 1
        for contact in contacts:
            i += 1
            if i%2:
                self.tree.insert('', tk.END, values=contact, tags = ('oddrow',))
            else:
                self.tree.insert('', tk.END, values=contact, tags = ('evenrow',))
            
    def item_selected(self, event):
        selected_item = self.tree.selection()[0]  # Récupère l'ID de l'élément sélectionné
        self.numero_ligne = self.tree.index(selected_item)  # Récupère l'index de l'élément sélectionné dans le Treeview
        print("Numéro de ligne sélectionné :", self.numero_ligne+1)  # Affiche le numéro de ligne 

    def habillage_tableau(self):
       # Création et configuration de la Scrollbar
        scrollbar = ttk.Scrollbar(self, orient=tk.VERTICAL, command=self.tree.yview)
        self.tree.configure(yscroll=scrollbar.set)
        scrollbar.grid(row=0, column=1, sticky='ns')

        # style row colors
        self.tree.tag_configure('oddrow', background='lightgrey')
        self.tree.tag_configure('evenrow', background='white')

if __name__ == '__main__':       
    root = tk.Tk()
    root.title("fenêtre principale")
    root.resizable(width=False,height=False)
    tableau = Tableau_patients(root, 'http://127.0.0.1:5000/personnes')
    root.mainloop()